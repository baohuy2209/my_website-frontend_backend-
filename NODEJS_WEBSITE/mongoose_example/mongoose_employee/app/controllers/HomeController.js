class HomeController {
  // [GET] /
  index(req, res) {
    res.render("home/home");
  }
  // [GET] /about
  about(req, res) {
    res.render("home/about");
  }
  // [GET] /contact-us
  contact_us(req, res) {
    res.render("home/contact_us");
  }
}
module.exports = new HomeController();
