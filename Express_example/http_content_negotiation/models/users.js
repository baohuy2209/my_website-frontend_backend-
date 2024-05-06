"user strict";

var users = require("../db/index");

exports.html = function (req, res) {
  res.send(
    "<ul>" +
      users
        .map(function (user) {
          return "<li>" + user.name + "\n";
        })
        .join("") +
      "</ul>"
  );
};

exports.text = function (req, res) {
  res.send(
    users
      .map(function (user) {
        return "-" + user.name + "\n";
      })
      .join("")
  );
};
exports.json = function (req, res) {
  res.json(users);
};
