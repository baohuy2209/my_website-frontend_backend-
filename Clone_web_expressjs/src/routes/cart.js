const express = require("express");
const router = express.Router();

const cartController = require("../app/controllers/CartController.js");
router.get("/", cartController.show_cart);
module.exports = router;
