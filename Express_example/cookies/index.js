"use strict";
const express = require("express");
const app = express();
const logger = require("morgan");
const cookieParser = require("cookie-parser");
const port = 3000;
if (process.env.NODE_DEV !== "test") {
  app.use(logger(":method :url"));
}

app.use(cookieParser("my secret here"));
app.use(
  express.urlencoded({
    extended: false,
  })
);
app.get("/", function (req, res) {
  if (req.cookies.remember) {
    // then click checkbox
    res.send('Remembered :). Click to <a href="/forget">forget</a>!.');
  } else {
    // begin
    res.send(
      '<form method="post"><p>Check to <label>' +
        '<input type="checkbox" name="remember"/> remember me</label> ' +
        '<input type="submit" value="Submit"/>.</p></form>'
    );
  }
});

app.get("/forget", function (req, res) {
  res.clearCookie("remember"); // clear cookie
  res.redirect("back"); // back to root page
});

app.post("/", function (req, res) {
  var minute = 60000;
  if (req.body.remember) res.cookie("remember", 1, { maxAge: minute });
  res.redirect("back");
});
app.listen(port, () => {
  console.log(`Listening on http://localhost:${port}`);
});
