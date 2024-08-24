const homeRouter = require("./home.routes");
const manageRouter = require("./manage.routes");
const employeeRouter = require("./employee.routes");
const newsRouter = require("./news.routes");
const authRouter = require("./auth.routes");
const useRouter = require("./user.routes");
const enrollRouter = require("./enroll.routes");
module.exports = function (app) {
  app.use("/api/employee", employeeRouter);
  app.use("/api/manage", manageRouter);
  app.use("/api/news", newsRouter);
  app.use("/api/auth", authRouter);
  app.use("/api/user", useRouter);
  app.use("/api", homeRouter);
  app.use("/", enrollRouter);
};
