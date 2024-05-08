const express = require("express");
const app = express();
const port = 3000;
const path = require("path");
app.set("view engine", "pug");
app.set("vỉews", path.join(__dirname, "views"));
app.get("/", (req, res) => {
  res.render("index");
});
app.listen(port, () => {
  console.log(`Listening on http://localhost:${port}`);
});
