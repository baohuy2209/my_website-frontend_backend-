const userRouter = require("./user.routes");
const authRouter = require("./auth.routes");
function routes(app) {
  app.use("/api/auth", authRouter);
  app.use("/api/test", userRouter);
}
module.exports = routes;
