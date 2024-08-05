const controller = require("../controllers/auth.controller");
const { verifySignUp } = require("../middleware/index");
const express = require("express");
const router = express.Router();
router.use(function (req, res, next) {
  res.header("Access-Control-Allow-Headers", "Origin, Content-Type, Accept");
  next();
});
router.post(
  "/signup",
  [verifySignUp.checkDuplicatedUsernameOrEmail, verifySignUp.checkRolesExisted],
  controller.registerUser
);
router.post("/signin", controller.loginUser);
router.post("/signout", controller.signout);
router.get("/current", controller.currentUser);
module.exports = router;
