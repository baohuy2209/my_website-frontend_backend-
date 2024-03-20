var express = require("express");
var path = require("path");
var hash = require("pbkdf2-password")();
var session = require("express-session");
var app = express();

app.set("view engine", "ejs");
app.set("views", path.join(__dirname, "views"));
app.get("/", function (req, res) {
  res.redirect("/login");
});

app.get("/login", function (req, res) {
  res.render("login");
});
app.listen(8080, () => {
  console.log(`Listening on http://localhost:8080`);
});
