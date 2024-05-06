var express = require("express");
var app = express();
var users = require("./db/index");
const port = 3000;
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
            return " - " + user.name + " \n ";
          })
          .join("")
      );
    },
    json: function () {
      res.json(users);
    },
  });
});

function format(path) {
  var obj = require(path);
  return function (req, res) {
    res.format(obj);
  };
}

app.get("/users", format("./models/users"));
app.listen(port, () => {
  console.log(`Listening on http://localhost:${port}`);
});
