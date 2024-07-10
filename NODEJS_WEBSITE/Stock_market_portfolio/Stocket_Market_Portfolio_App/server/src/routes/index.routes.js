const AppRoutes = require("./app.routes");
function route(app) {
  app.use("/api", AppRoutes);
}
module.exports = route;
