const homeRouter = require("./home");
const gettingStartedRouter = require("./getting_started");
const apireferenceRouter = require("./API_reference");
const guideRouter = require("./guide");
const adv_topicRouter = require("./Advance_topics");
const resourcesRouter = require("./Resources");
const enrollRouter = require("./enroll");
const bookRouter = require("./Book");
const courseRouter = require("./courses");
const meRouter = require("./me");
const cartRouter = require("./cart");
function route(app) {
  app.use("/Resources", resourcesRouter); // routers for resources
  app.use("/Advanced_topics", adv_topicRouter); // router for Advanced topics
  app.use("/Guide", guideRouter); // router for Guide
  app.use("/API_reference", apireferenceRouter); //router for API reference
  app.use("/Getting_started", gettingStartedRouter); // router for getting started
  app.use("/home", homeRouter); // router for home
  app.use("/courses", courseRouter); // router for reference courses
  app.use("/book_reference", bookRouter); // router for reference book
  app.use("/me", meRouter); // router for information about books and courses
  app.use("/cart", cartRouter); // cart page
  app.use("/", enrollRouter); // home
}
module.exports = route;
