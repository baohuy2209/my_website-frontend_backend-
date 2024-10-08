const express = require("express");
const router = express.Router();
const authJwt = require("../app/middleware/authJWT");
const controller = require("../app/controllers/UserController");
router.use(function (req, res, next) {
  res.header("Access-Control-Allow-Headers", "Origin, Content-Type, Accept");
  next();
});
router.get("/all", controller.allAccess);
router.get("/", [authJwt.verifyToken], controller.userBoard);
router.get(
  "/mod",
  [authJwt.verifyToken, authJwt.isModerator],
  controller.moderatorBoard
);
router.get(
  "/admin",
  [authJwt.verifyToken, authJwt.isAdmin],
  controller.adminBoard
);
module.exports = router;
