const authRouter = require("./auth.routes");
const userRouter = require("./user.routes");
const enrollRouter = require("./enroll.routes");
const homeRouter = require("./home.routes");
const bookRouter = require("./book.routes");
const adminBookRouter = require("./adminbook.routes");
function route(app) {
  app.use("/api/auth", authRouter);
  app.use("/api/user", userRouter);
  app.use("/api/home", homeRouter);
  app.use("/api/books", bookRouter);
  app.use("/api/manage", adminBookRouter);
  app.use("/api", enrollRouter);
}
module.exports = route;
