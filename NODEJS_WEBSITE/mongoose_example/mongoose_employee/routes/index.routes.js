const homeRouter = require("./home.routes");
const manageRouter = require("./manage.routes");
const employeeRouter = require("./employee.routes");
module.exports = function (app) {
  app.use("/employee", employeeRouter);
  app.use("/manage", manageRouter);
  app.use("/", homeRouter);
};
