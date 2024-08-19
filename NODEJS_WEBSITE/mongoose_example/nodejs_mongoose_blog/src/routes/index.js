const newsRouter = require("./news.routes");
const meRouter = require("./me.routes");
const coursesRouter = require("./courses.routes");
const siteRouter = require("./site.routes");
function route(app) {
  app.use("/news", newsRouter);
  app.use("/me", meRouter);
  app.use("/courses", coursesRouter);
  app.use("/site", siteRouter);
}
module.exports = route;
