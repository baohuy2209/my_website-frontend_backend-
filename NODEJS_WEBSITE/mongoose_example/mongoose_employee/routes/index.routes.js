const homeRouter = require("./home.routes");
module.exports = function (app) {
  app.use("/", homeRouter);
};
