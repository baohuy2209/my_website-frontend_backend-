const ROLES = require("../constants/roles");
const User = require("../models/user.model");
checkDuplicatedUsernameOrEmail = (req, res, next) => {
  User.findOne({ username: req.body.username })
    .then((user) => {
      if (user) {
        res.status(400).json({ message: "Failed! Username is already in use" });
        return;
      }
      User.findOne({
        email: req.body.email,
      })
        .then((user) => {
          if (user) {
            res
              .status(400)
              .json({ message: "Failed! Email is already in use" });
          }
          next();
        })
        .catch((error) => {
          res.status(500).json({ message: error });
        });
    })
    .catch((error) => {
      res.status(500).json({ message: error });
    });
};
checkRolesExisted = (req, res, next) => {
  if (req.body.roles) {
    for (let i = 0; i < req.body.roles.length; i++) {
      if (!ROLES.includes(req.body.roles[i])) {
        res
          .status(400)
          .json({
            message: `Failed! Role ${req.body.roles[i]} does not exist`,
          });
        return;
      }
    }
  }
  next();
};
const AuthService = {
  checkDuplicatedUsernameOrEmail,
  checkRolesExisted,
};
module.exports = AuthService;
