class HomeController {
  // [GET] /
  index(req, res) {
    res.render("home");
  }
  about(req, res) {}
  contact_us(req, res) {}
}
module.exports = new HomeController();
