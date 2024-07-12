const express = require("express");
const router = express.Router();
const controller = require("../controllers/User.controller");
const validateToken = require("../middleware/validateTokenHandler");
router.post("/register", controller.registerUser);
router.post("/login", controller.loginUser);
router.get("/current", validateToken, controller.currentUser);
module.exports = router;
