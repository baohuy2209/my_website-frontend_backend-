const express = require("express");
const router = express.Router();
const enrollController = require("../app/controllers/EnrollController.js");

router.post("/store_account", enrollController.store_account);
router.get("/", enrollController.page_login_logout);

module.exports = router;
