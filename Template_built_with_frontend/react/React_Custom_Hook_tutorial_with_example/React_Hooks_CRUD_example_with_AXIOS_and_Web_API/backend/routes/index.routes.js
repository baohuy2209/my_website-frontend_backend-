const tutorialRouter = require("./tutorial.routes");
function routes(app) {
  app.use("/api/tutorials", tutorialRouter);
}
module.exports = routes;
