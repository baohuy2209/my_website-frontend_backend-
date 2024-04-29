function route(app) {
  const tutorials = require("../controllers/tutorial.controller.js");
  var router = require("express").Router();

  //Retrieve all publish Tutorials
  router.get("/published", tutorials.findAllPublished);
  // Retrieve all Tutorial
  router.get("/", tutorials.findAll);

  app.use("/api/tutorials", router);
}
module.exports = route;
