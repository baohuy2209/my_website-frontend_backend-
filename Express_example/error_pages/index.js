var express = require("express");
var path = require("path");
var app = express();
var logger = require("morgan");
var silent = process.env.NODE_ENV === "test";
const port = 3000;
// set views
app.set("views", path.join(__dirname, "views"));
// set views ejs
app.set("view engine", "ejs");

app.enable("verbose errors");
if (app.settings.env === "production") {
  app.disable("verbose errors");
}

silent || app.use(logger("dev"));

app.get("/", function (req, res) {
  res.render("index.ejs");
});

app.get("/404", function (req, res) {
  next();
});
app.get("/403", function (req, res, next) {
  var err = new Error("not allowed");
  err.status = 403;
  next(err);
});
app.get("/500", function (req, res, next) {
  next(new Error("keyboard cat !"));
});

app.use(function (req, res, next) {
  res.status(404);
  res.format({
    html: function () {
      res.render("404", { url: req.url });
    },
    json: function () {
      res.json({ error: "Not found" });
    },
    default: function () {
      res.type("txt").send("Not found");
    },
  });
});

app.use(function (err, req, res, next) {
  res.status(err.status || 500);
  res.render("500", { error: err });
});

app.listen(port, () => {
  console.log(`Listening on http://localhost:${port}`);
});
