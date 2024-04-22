const register_route = require("./authentication.routes");
function route(app) {
  app.use("/", register_route);
}
module.exports = route;
