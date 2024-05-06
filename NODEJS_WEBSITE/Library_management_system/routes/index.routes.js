const home = require("./home.routes");
function route(app) {
  app.use("/", home);
}
module.exports = route;
