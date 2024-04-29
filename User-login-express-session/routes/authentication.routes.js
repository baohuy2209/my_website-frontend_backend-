const express = require("express");
const router = express.Router();
const register_controller = require("../app/controllers/register.controller");
const isAuthenticated = require("../app/middleware/isAuthenticated.middleware");
router.post("/login", register_controller.register_login);
router.get("/sign_in", register_controller.signin_form);
router.get("/logout", register_controller.register_logout);
router.get("/sign_up", register_controller.register_form);
router.get("/", isAuthenticated, register_controller.authentication);
router.get("/", register_controller.signin_form);

module.exports = router;
