const jwt = require("jsonwebtoken");
const User = require("../models/user.model");
const Role = require("../models/role.model");
const ROLES = require("../../config/roles/roles");
checkUsernameOrEmailDuplicated = (req, res, next) => {
  User.findOne({
    username: req.body.username,
  })
    .then((user) => {
      if (user) {
        res.status(400);
        throw new Error("Failed! Username is already in use");
      }
      User.findOne({
        email: req.body.email,
      })
        .then((user) => {
          if (user) {
            res.status(400);
            throw new Error("Failed! Email is already in use");
          }
          next();
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
CheckRolesExisted = (req, res, next) => {
  if (req.body.roles) {
    for (let i = 0; i < req.body.roles.length; i++) {
      if (!ROLES.includes(req.body.roles[i])) {
        res.status(400);
        throw new Error(`Failed! Role ${req.body.roles[i]} does not exist!`);
      }
    }
  }
  next();
};
const verifySignUp = {
  checkUsernameOrEmailDuplicated,
  CheckRolesExisted,
};
module.exports = verifySignUp;
