const jwt = require("jsonwebtoken");
const User = require("../models/user.model");
const Role = require("../models/role.model");
verifyToken = (req, res, next) => {
  let token = req.headers["x-access-token"];
  if (!token) {
    return res.status(403).json({ message: "No token provided" });
  }
  jwt.verify(token, process.env.VERIFY_TOKEN, (err, decoded) => {
    if (err) {
      return res.status(401).json({ message: "Unauthorized!" });
    }
    res.userId = decoded.id;
    next();
  });
};
isAdmin = (req, res, next) => {
  User.findById(req.userId)
    .then((user) => {
      Role.find({
        _id: { $in: user.roles },
      })
        .then((roles) => {
          for (let i = 0; i < roles.length; i++) {
            if (roles[i] === "admin") {
              next();
              return;
            }
          }
          res.status(403).json({ message: "Require Admin Role!" });
        })
        .catch((error) => {
          res.status(500).json({ message: error });
        });
    })
    .catch((error) => {
      res.status(500).json({ message: error });
      return;
    });
};
isModerator = (req, res, next) => {
  User.findById(req.userId)
    .then((user) => {
      Role.find({
        _id: { $in: user.roles },
      })
        .then((roles) => {
          for (let i = 0; i < roles.length; i++) {
            if (roles[i] === "moderator") {
              next();
              return;
            }
          }
          res.status(403).json({ message: "Require Moderator Role!" });
        })
        .catch((error) => {
          res.status(500).json({ message: error });
        });
    })
    .catch((error) => {
      res.status(500).json({ message: error });
      return;
    });
};
const authJWT = {
  verifyToken,
  isAdmin,
  isModerator,
};
module.exports = authJWT;
