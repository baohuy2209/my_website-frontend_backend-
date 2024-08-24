const express = require("express");
const router = express.Router();
const controller = require("../app/controllers/EnrollController");
router.get("/login", controller.login);
router.get("/signup", controller.signup);
router.get("/get_forgetedpassword", controller.forgot_password);
module.exports = router;
