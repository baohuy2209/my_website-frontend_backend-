"use strict";
var express = require("express");
var GithubView = require("./github-view");
var md = require("marked").parse;
var app = (module.exports = express());
const dotenv = require("dotenv");
dotenv.config();
const PORT = process.env.PORT || 8080;
app.engine("md", function (str, options, fn) {
  try {
    var html = md(str);
    html = html.replace(/\{([^}]+)\}/g, function (_, name) {
      return options[name] || "";
    });
    fn(null, html);
  } catch (err) {
    fn(err);
  }
});
app.set("views", "expressjs/express");
app.set("view", GithubView);
app.get("/", function (req, res) {
  res.render("examples/markdown/views/index.md", { title: "Example" });
});

app.get("/Readme.md", function (req, res) {
  res.render("Readme.md");
});
app.listen(PORT, () => {
  console.log(`Listening on http://localhost:${PORt}`);
});
