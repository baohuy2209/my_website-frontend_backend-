const controller = require("../controllers/home.controller");
module.exports = function (app) {
  app.get("/", controller.index);
};
