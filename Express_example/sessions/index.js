"use strict";
const express = require("express");
const session = require("express-session");
const port = 3000;
const app = express();
app.use(
  session({
    resave: false, // don't save session
    saveUninitialized: false, // don't create session until something stored
    secret: "keyboard cat",
  })
);

app.get("/", function (req, res) {
  var body = "";
  if (req.session.views) {
    ++req.session.views;
  } else {
    req.session.views = 1;
    body += "<p>First time visiting? view this page in several browsers :)</p>";
  }
  res.send(
    body + "<p> Viewed <strong>" + req.session.views + "</strong> times</p>"
  );
});
app.listen(port, () => {
  console.log(`Listening on http://localhost:${port}`);
});
