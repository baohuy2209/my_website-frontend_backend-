const express = require("express");
const router = express.Router();
const homeController = require("../app/controllers/HomeController");
router.get("/", homeController.home);
router.get("/contact_us", homeController.contact_us);
router.post("/contact_us", homeController.store_contact);
module.exports = router;
