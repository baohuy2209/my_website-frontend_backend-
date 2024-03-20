const homeRouter = require("./home");
const gettingStartedRouter = require("./getting_started");
const apireferenceRouter = require("./API_reference");
const guideRouter = require("./guide");
const adv_topicRouter = require("./Advances_topics");
const resourcesRouter = require("./Resources");
const enrollRouter = require("./enroll");
const bookRouter = require("./book");
const courseRouter = require("./courses");
const meRouter = require("./me");
const cartRouter = require("./cart");
function route(app) {
  app.use("/Resources", resourcesRouter);
  app.use("/Advanced_topics", adv_topicRouter);
  app.use("/Guide", guideRouter);
  app.use("/API_reference", apireferenceRouter);
  app.use("/Getting_started", gettingStartedRouter);
  app.use("/home", homeRouter);
  app.use("/courses", courseRouter);
  app.use("/book_reference", bookRouter);
  app.use("/me", meRouter);
  app.use("/cart", cartRouter);
  app.use("/", enrollRouter);
}
module.exports = route;
