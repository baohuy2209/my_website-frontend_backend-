const express = require("express");
const router = express.Router();
const manageController = require("../app/controllers/ManageController");
router.get("/stored/employee", manageController.stored);
router.get("/trash/employee", manageController.trash);
module.exports = router;
