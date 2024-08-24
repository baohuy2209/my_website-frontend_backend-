const jwt = require("jsonwebtoken");
const config = require("../../config/auth.cofig");
const User = require("../models/user.model");
const Role = require("../models/role.model");
verifyToken = (req, res, next) => {
  let token = req.session.token;
  if (!token) {
    res.status(403);
    throw new Error("No token provided");
  }
  let authHeader = req.headers.Authorization || req.headers.authorization;
  if (authHeader && authHeader.startWith("Bearer")) {
    jwt.verify(token, config.secret, (err, decoded) => {
      if (err) {
        res.status(401);
        throw new Error("Unauthorized !");
      }
      req.userId = decoded.id;
    });
  }
};
isAdmin = (req, res, next) => {
  User.findById(req.userId)
    .then((user) => {
      Role.find({
        _id: { $in: user.roles },
      })
        .then((roles) => {
          for (let i = 0; i < roles.length; i++) {
            if (roles[i].name == "admin") {
              next();
              return;
            }
          }
          res.status(403);
          throw new Error("Require Admin Role!");
        })
        .catch((err) => {
          res.status(500);
          throw new Error(JSON.stringify(err));
        });
    })
    .catch((err) => {
      res.status(500);
      throw new Error(JSON.stringify({ message: err }));
    });
};
isModerator = (req, res, next) => {
  User.findById(req.userId)
    .then((user) => {
      Role.find({
        _id: { $in: user.roles },
      }).then((roles) => {
        for (let i = 0; i < roles.length; i++) {
          if (roles[i].name === "moderator") {
            next();
            return;
          }
        }
        res.status(403);
        throw new Error("Require Admin Role!");
      });
    })
    .catch((err) => {
      res.status(500);
      throw new Error(JSON.stringify({ message: err }));
    });
};
const authJWT = {
  verifyToken,
  isAdmin,
  isModerator,
};
module.exports = authJWT;
