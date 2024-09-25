const express = require("express");
const router = express.Router();
const authService = require("../service/AuthService.service");
const controller = require("../controllers/AuthController");
router.use(function (req, res, next) {
  res.header("Access-Control-Allow-Headers", "x-access-token");
  next();
});
router.post(
  "/signup",
  [authService.checkDuplicatedUsernameOrEmail, authService.checkRolesExisted],
  controller.signup
);
router.post("/signin", controller.signin);
module.exports = router;
