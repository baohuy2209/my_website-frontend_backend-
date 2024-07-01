const { verifySignup } = require("../app/middleware");
const controller = require("../app/controllers/auth.controller");
const express = require("express");
const router = express.Router();
router.use(function (req, res, next) {
  res.header("Access-Control-Allow-Headers", "Origin, Content-Type, Accept");
  next();
});
router.post(
  "/signup",
  [verifySignup.checkDuplicatedUsernameOrEmail, verifySignup.checkRolesExisted],
  controller.signup
);
router.post("/signin", controller.signin);
router.post("/signout", controller.signout);
