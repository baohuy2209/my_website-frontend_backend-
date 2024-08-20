const express = require("express");
const router = express.Router();
const manageController = require("../app/controllers/ManageController");
router.get("/stored", manageController.stored);
router.get("/trash", manageController.trash);
module.exports = router;
