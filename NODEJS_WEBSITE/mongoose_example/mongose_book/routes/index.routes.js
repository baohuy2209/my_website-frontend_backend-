const authRouter = require("./auth.routes");
const userRouter = require("./user.routes");
function route(app) {
  app.use("/api/auth", authRouter);
  app.use("/api/user", userRouter);
}
module.exports = route;
