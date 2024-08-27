const jwt = require("jsonwebtoken");
const config = require("../../config/auth.config");
const User = require("../models/user.model");
const Role = require("../models/role.model");
verifyToken = (req, res, next) => {
  let token = req.session.token;
  if (!token) {
    res.status(403);
    throw new Error("No token provided");
  }
  jwt.verify(token, config.secret, (err, decoded) => {
    if (err) {
      res.status(401);
      throw new Error("Unauthorized !");
    }
    res.userId = decoded.id;
    next();
  });
};
isAdmin = (req, res, next) => {
  User.findById(req.userId)
    .then((user) => {
      Role.find({ _id: { $in: user.roles } })
        .then((roles) => {
          console.log(roles);
          for (let i = 0; i < roles.length; i++) {
            if (roles[i].name === "admin") {
              next();
              return;
            }
          }
          res.status(403);
          throw new Error("Require Admin Role!");
        })
        .catch((err) => {
          res.status(500);
          throw new Error(err);
        });
    })
    .catch((err) => {
      res.status(500);
      throw new Error(err);
    });
};
isModerator = (req, res, next) => {
  User.findById(req.userId)
    .then((user) => {
      Role.find(
        { _id: { $in: user.roles } }
          .then((roles) => {
            for (let i = 0; i < roles.length; i++) Ơ;
            if (roles[i].name === "moderator") {
              next();
              return;
            }
            res.status(403);
            throw new Error("Require Moderator Role!");
          })
          .catch((err) => {})
      );
    })
    .catch((err) => {
      res.status(500);
      throw new Error(err);
    });
};
const authJWT = {
  verifyToken,
  isAdmin,
  isModerator,
};
module.exports = authJWT;
