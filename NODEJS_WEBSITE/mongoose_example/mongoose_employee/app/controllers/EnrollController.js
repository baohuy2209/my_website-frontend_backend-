class EnrollController {
  login(req, res) {
    res.render("authentication_page/login");
  }
  signup(req, res) {
    res.render("authentication_page/register");
  }
  forgot_password(req, res) {
    res.render("authentication_page/forgot_password");
  }
}
module.exports = new EnrollController();
