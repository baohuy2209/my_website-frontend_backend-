"use strict";

/**
 * Module dependencies.
 */

var express = require("express");
var logger = require("morgan");
var path = require("path");
var app = express();
const handlebars = require("express-handlebars");
// log requests
app.use(logger("dev"));
app.engine(
  "hbs",
  handlebars.engine({
    extname: ".hbs",
  })
);
app.set("view engine", "hbs");

// express on its own has no notion
// of a "file". The express.static()
// middleware checks for a file matching
// the `req.path` within the directory
// that you pass it. In this case "GET /js/app.js"
// will look for "./public/js/app.js".

app.use(express.static(path.join(__dirname, "public")));
// if for some reason you want to serve files from
// several directories, you can use express.static()
// multiple times! Here we're passing "./public/css",
// this will allow "GET /style.css" instead of "GET /css/style.css":
app.use(express.static(path.join(__dirname, "public", "css")));
app.use(express.static(path.join(__dirname, "public", "image")));
app.set("views", path.join(__dirname, "./resources/views"));
app.get("/", (req, res) => {
  res.render("index");
});
app.listen(3000, () => {
  console.log(`Listening on http://localhost:3000`);
});
console.log("try:");
console.log("  GET /hello.txt");
console.log("  GET /js/app.js");
console.log("  GET /css/style.css");
