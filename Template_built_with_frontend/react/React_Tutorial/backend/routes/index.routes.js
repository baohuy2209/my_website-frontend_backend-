const contactRouter = require("./contact.routes");
function routes(app) {
  app.use("/api/contacts", contactRouter);
}
module.exports = routes;
