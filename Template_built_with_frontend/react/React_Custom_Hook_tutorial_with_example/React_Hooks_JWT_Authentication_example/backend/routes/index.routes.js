const userRouter = require("./user.routes");
const authRouter = require("./auth.routes");
router.use(function (req, res, next) {
  res.header(
    "Access-Control-Allow-Headers",
    "x-access-token, Origin, Content-Type, Accept"
  );
  next();
});
function routes(app) {
  app.use("/api/auth", authRouter);
  app.use("/api/test", userRouter);
}
module.exports = routes;
