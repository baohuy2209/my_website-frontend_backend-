const escapeHtml = require("escape-html");
class register_controller {
  // {GET} after signin
  authentication(req, res) {
    res.send(
      "hello, " +
        escapeHtml(req.session.user) +
        "!" +
        '<a href = "/logout">Logout</a>'
    );
  }
  // [GET] render form to sign up new account
  register_form(req, res) {
    res.render("form_signup");
  }
  // [GET] render form to sign in
  signin_form(req, res) {
    res.render("form_login");
  }
  // [POST] login to new session
  register_login(req, res, next) {
    req.session.regenerate(function (err) {
      if (err) {
        next(err);
      }
      req.session.user = req.body.user;
      req.session.save(function (err) {
        if (err) {
          return next(err);
        }
        res.redirect("/");
      });
    });
  }
  // [GET] exit session
  register_logout(req, res, next) {
    req.session.user = null;
    res.session.save(function (err) {
      if (err) {
        next(err);
      }
      req.session.regenerate(function (err) {
        if (err) {
          next(err);
        }
        res.redirect("/");
      });
    });
  }
}

module.exports = new register_controller();
