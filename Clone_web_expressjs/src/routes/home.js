const express = require("express");
const router = express.Router();

const homeController = require("../app/controllers/HomeController.js");

router.get("/", homeController.render_home);

module.exports = router;
