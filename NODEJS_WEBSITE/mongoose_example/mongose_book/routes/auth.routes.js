const express = require("express");
const router = express.Router();
const verifySignup = require("../app/middleware/verifySignUp");
const controller = require("../app/controllers/AuthController");
router.post(
  "/signup",
  [verifySignup.checkUsernameOrEmailDuplicated, verifySignup.CheckRolesExisted],
  controller.register
);
router.post("/signin", controller.signin);
router.get("/signout", controller.signout);
module.exports = router;
