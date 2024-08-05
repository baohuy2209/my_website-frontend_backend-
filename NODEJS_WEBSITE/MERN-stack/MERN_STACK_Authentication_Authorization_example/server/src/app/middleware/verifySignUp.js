const db = require("../models");
const ROLES = db.ROLES;
const User = db.user;
const checkDuplicatedUsernameOrEmail = (req, res, next) => {
  User.findOne({
    username: req.body.username,
  }).exec((err, user) => {
    if (err) {
      res.status(500);
      throw new Error("Server error: ");
    }
    if (user) {
      res.status(400);
      throw new Error("Failed| Username is already in use");
    }
    User.findOne({
      email: req.body.email,
    }).exec((err, user) => {
      if (err) {
        res.status(500);
        throw new Error("Server error !");
      }
      if (user) {
        res.status(400);
        throw new Error("Failed| Email is already in use !");
      }
      next();
    });
  });
};
const checkRolesExisted = (req, res, next) => {
  if (req.body.roles) {
    for (let i = 0; i < req.body.roles.length; i++) {
      if (ROLES.includes(req.body.roles[i])) {
        res.status(400);
        throw new Error(`Failed! Role ${req.body.roles[i]} does not exist!`);
      }
    }
  }
  next();
};
const verifySignUp = {
  checkDuplicatedUsernameOrEmail,
  checkRolesExisted,
};
module.exports = verifySignUp;
