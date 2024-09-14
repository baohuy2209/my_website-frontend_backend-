const express = require("express");
const router = express.Router();
const controller = require("../controllers/UserController");
const authJWT = require("../middleware/authJWT");
router.get("/all", controller.getPublicContent);
router.get("/user", [authJWT.verifyToken], controller.getUserBoard);
router.get(
  "/mod",
  [authJWT.verifyToken, authJWT.isModerator],
  controller.getModeratorBoard
);
router.get(
  "/admin",
  [authJWT.verifyToken, authJWT.isAdmin],
  controller.getAdminBoard
);
module.exports = router;
