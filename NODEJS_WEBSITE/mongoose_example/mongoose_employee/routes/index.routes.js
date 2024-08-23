const homeRouter = require("./home.routes");
const manageRouter = require("./manage.routes");
const employeeRouter = require("./employee.routes");
const newsRouter = require("./news.routes");
module.exports = function (app) {
  app.use("/api/employee", employeeRouter);
  app.use("/api/manage", manageRouter);
  app.use("/api/news", newsRouter);
  app.use("/api", homeRouter);
};
