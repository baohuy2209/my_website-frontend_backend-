const express = require("express");
const router = express.Router();
const enrollController = require("../app/controllers/EnrollController");
router.get("/login", enrollController.login_page);
router.get("/signup", enrollController.signup_page);
router.get("/forgot_password", enrollController.forgot_password);
module.exports = router;
