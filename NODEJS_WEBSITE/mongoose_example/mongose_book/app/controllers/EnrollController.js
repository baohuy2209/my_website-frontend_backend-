class EnrollController {
  login_page = (req, res) => {
    res.render("authentication/login_page");
  };
  signup_page = (req, res) => {
    res.render("authentication/signup_page");
  };
  forgot_password = (req, res) => {
    res.render("authentication/forgot_password_page");
  };
}
module.exports = new EnrollController();
