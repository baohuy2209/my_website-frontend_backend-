const express = require("express");
const app = express();
const path = require("path");
const handlebars = require("express-handlebars");
app.engine(
  "hbs",
  handlebars.engine({
    extname: ".hbs",
    helpers: {
      sum: (a, b) => a + b,
    },
  })
);
app.set("view engine", "hbs");
app.set("views", path.join(__dirname, "./resources/views"));
app.get("/", (req, res) => {
  res.render("home");
});
app.listen(3000, () => {
  console.log("Listening on http://localhost:3000");
});
