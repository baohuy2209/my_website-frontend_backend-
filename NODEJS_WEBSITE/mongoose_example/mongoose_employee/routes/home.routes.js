const express = require("express");
const router = express.Router();
const homeController = require("../app/controllers/HomeController");
router.get("/about", homeController.about);
router.get("/contact-us", homeController.contact_us);
router.get("/", homeController.index);
module.exports = router;
