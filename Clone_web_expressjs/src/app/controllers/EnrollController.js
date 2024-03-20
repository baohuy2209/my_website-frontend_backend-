const User = require("../models/user.js");

class EnrollerController {
  page_login_logout(req, res) {
    res.render("./login_logout/login");
  }

  store_account(req, res, next) {
    const format = req.body;
    const user = new User(format);

    user
      .save()
      .then(() => res.redirect("/home"))
      .catch(next);
  }
}
module.exports = new EnrollerController();
