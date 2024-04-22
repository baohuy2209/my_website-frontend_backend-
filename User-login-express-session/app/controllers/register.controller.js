const escapeHtml = require("escape-html");
class register_controller {
  authentication(req, res) {
    res.send(
      "hello, " +
        escapeHtml(req.session.user) +
        "!" +
        '<a href = "/logout">Logout</a>'
    );
  }
  register_form(req, res) {
    res.send(
      '<form action="/login" method="post">' +
        'Username: <input name="user"><br>' +
        'Password: <input name="pass" type="password"><br>' +
        '<input type="submit" text="Login"></form>'
    );
  }
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
