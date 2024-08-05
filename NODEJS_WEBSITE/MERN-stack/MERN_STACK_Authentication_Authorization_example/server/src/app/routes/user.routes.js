const { authJwt } = require("../middleware/index");
const controller = require("../controllers/user.controller");
const express = require("express");
const router = express.Router();
router.use(function (req, res, next) {
  res.header("Access-Control-Allow-Headers", "Origin, Content-Type, Accept");
  next();
});
router.get("/all", controller.allAccess);
router.get("/user", [authJwt.validateToken], controller.userBoard);
router.get(
  "/mod",
  [authJwt.validateToken, authJwt.isModerator],
  controller.moderatorBoard
);
router.get(
  "/admin",
  [authJwt.validateToken, authJwt.isAdmin],
  controller.adminBoard
);
module.exports = router;
