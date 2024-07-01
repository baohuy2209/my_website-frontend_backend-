import express from "express";
const router = express.Router();
import controller from "../../app/controller/user.controller";
import verifyjwt from "../../app/middleware/verifyToken";
router.use(function (
  req: express.Request,
  res: express.Response,
  next: express.NextFunction
) {
  res.header("Access-Control-Allow-Headers", "Origin, Content-Type, Accept");
  next();
});
router.get("/all", controller.allAccess);
router.get(
  "/moderator",
  [verifyjwt.verifyToken, verifyjwt.isModerator],
  controller.moderatorBoard
);
router.get(
  "/admin",
  [verifyjwt.verifyToken, verifyjwt.isAdmin],
  controller.adminBoard
);
router.get("/", [verifyjwt.verifyToken], controller.userBoard);
export default router;
