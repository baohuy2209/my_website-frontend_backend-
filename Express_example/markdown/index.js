"use strict";
var escapeHtml = require("escape-html");
var express = require("express");
var fs = require("fs");
var marked = require("marked");
var path = require("path");
const port = 3000;
const app = express();
app.engine("md", function (path, options, fn) {
  fs.readFile(path, "utf8", function (err, str) {
    if (err) {
      return fn(err);
    }
    var html = marked.parse(str).replace(/\{([^}]+)\}/g, function (_, name) {
      return escapeHtml(options[name] || "");
    });
    fn(null, html);
  });
});

app.set("views", path.join(__dirname, "views"));
app.set("view engine", "md");
app.get("/", function (req, res) {
  res.render("index", { title: "Markdown Example" });
});

app.get("/fail", function (req, res) {
  res.render("missing", { title: "Markdown Example" });
});
app.listen(port, () => {
  console.log(`Listening on http://localhost:${port}`);
});
