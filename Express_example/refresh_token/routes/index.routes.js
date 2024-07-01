const authRouter = require("./auth.routes");
const userRouter = require("./user.routes");
const homeRouter = require("./home.routes");
module.exports = function route(app) {
  app.use("/api/auth", authRouter);
  app.use("/api/test", userRouter);
  app.use("/", homeRouter);
};
