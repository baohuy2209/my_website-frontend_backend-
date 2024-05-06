"use strict";
const express = require("express");
const app = express();
var logger = require("morgan");
var path = require("path");
var session = require("express-session");
var methodOverride = require("method-override");
const port = 3000;
// set ejs package to use in views
app.set("view engine", "ejs");
// set views of website in file views
app.set("views", path.join(__dirname, "views"));

app.response.message = function (msg) {
  var sess = this.req.session;

  sess.message = sess.messages || [];
  sess.messages.push(msg);

  return this;
};

if (!module.parent) {
  app.use(logger("dev"));
}
// set static file
app.use(express.static(path.join(__dirname, "public")));
// set session middleware
app.use(
  session({
    resave: false,
    saveUninitialized: false,
    secret: "some secret here",
  })
);

app.use(
  express.urlencoded({
    extended: true,
  })
);
// use middleware method override
app.use(methodOverride("_method"));
app.use(function (req, res, next) {
  var msg = req.session.messages || [];

  res.locals.messages = msg;
  res.locals.hasMessages = !!msg.length;
  next();
  req.session.messages = [];
});

require("./lib/boot")(app, { verbose: !module.parent });

app.use(function (err, req, res, next) {
  if (!module.parent) {
    console.error(err.stack);
  }
  res.status(500).render("5xx");
});
app.use(function (req, res, next) {
  res.status(404).render("404", { url: req.originalUrl });
});

app.listen(port, () => {
  console.log(`Listening on http://localhost:${port}`);
});
