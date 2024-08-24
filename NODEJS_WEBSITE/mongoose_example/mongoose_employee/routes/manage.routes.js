const express = require("express");
const router = express.Router();
const manageController = require("../app/controllers/ManageController");
const authJwt = require("../app/middleware/auth.jwt");
router.get(
  "/stored/employee",
  [authJwt.isAdmin, authJwt.isModerator],
  manageController.stored
);
router.get(
  "/trash/employee",
  [authJwt.isAdmin, authJwt.isModerator],
  manageController.trash
);
module.exports = router;
