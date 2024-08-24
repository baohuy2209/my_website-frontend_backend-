const verifySignUp = require("../app/middleware/verifySignUp");
const controller = require("../app/controllers/AuthController");
const express = require("express");
const router = express.Router();
router.use(function (req, res, next) {
  res.header("Access-Control-Allow-Headers", "Origin, Content-Type, Accept");
  next();
});
router.post(
  "/signup",
  [verifySignUp.checkDuplicatieUsernameOrEmail, verifySignUp.checkRolesExisted],
  controller.register
);
router.post("/signin", controller.signin);
router.post("/signout", controller.signout);
module.exports = router;
