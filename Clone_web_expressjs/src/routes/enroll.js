const express = require("express");
const router = express.Router();
const { body } = require("express-validator");
const authRequired = require("../helpers/authRequired");
const enrollController = require("../app/controllers/EnrollController.js");

router.post("/create_new_account", enrollController.create_new_account);
router.get("/sign_up", enrollController.page_sign_up);
router.post("/sign_in", enrollController.login);
router.get("/current-user", authRequired, enrollController.currentUser);
router.get("/", enrollController.page_sign_in);

module.exports = router;
