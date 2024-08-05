const authRouter = require("./auth.routes");
const userRouter = require("./user.routes");
module.exports = function router(app) {
  app.use("/api/auth", authRouter);
  app.use("/api/user", userRouter);
};
