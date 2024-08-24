const authJwt = require("../app/middleware/auth.jwt");
const router = require("./home.routes");
const controller = require("../app/controllers/UserController");
router.use(function (req, res, next) {
  res.header("Access-Control-Allow-Headers", "Origin, Content-Type, Accept");
  next();
});
router.get("/all", controller.allAccess);
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
router.get("/", [authJwt.verifyToken], controller.userBoard);
module.exports = router;
