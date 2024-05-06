var db = require("../../db");
exports.engine = "hbs";
exports.before = function (req, res, next) {
  var id = req.params.user_id;
  if (!id) {
    return next();
  }
  process.nextTick(function () {
    req.user = db.users[id];
    if (!req.user) {
      return next("route");
    }
    next();
  });
};

exports.list = function (req, res, next) {
  res.render("list", {
    users: db.users,
  });
};
exports.edit = function (req, res, next) {
  res.render("user", {
    user: req.user,
  });
};
exports.show = function (req, res, next) {
  res.render("show", {
    user: req.user,
  });
};
exports.update = function (req, res, next) {
  var body = req.body;
  req.user.name = body.user.name;
  res.message("Information updated !");
  res.redirect("/user/" + req.user.id);
};
