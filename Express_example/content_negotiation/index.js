"use strict";

var express = require("express");
var app = express();
var users = require("./db");
const port = 3000;
// so either you can deal with different types of formatting
// for expected response in index.js
app.get("/", function (req, res) {
  res.format({
    html: function () {
      res.send(
        "<ul>" +
          users
            .map(function (user) {
              return "<li>" + user.name + "</li>";
            })
            .join("") +
          "</ul>"
      );
    },

    text: function () {
      res.send(
        users
          .map(function (user) {
            return " - " + user.name + "\n";
          })
          .join("")
      );
    },

    json: function () {
      res.json(users);
    },
  });
});

// or you could write a tiny middleware like
// this to add a layer of abstraction
// and make things a bit more declarative:

function format(path) {
  var obj = require(path);
  return function (req, res) {
    res.format(obj);
  };
}

app.get("/users", format("./users"));

/* istanbul ignore next */
app.listen(port, () => {
  console.log(`Listening on port http://localhost:${port}`);
});
