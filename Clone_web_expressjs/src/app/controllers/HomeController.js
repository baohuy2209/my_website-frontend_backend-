const books = require("../models/Book.js");
class HomeController {
  index(req, res) {}

  render_home(req, res) {
    res.render("home");
  }
}

module.exports = new HomeController();
