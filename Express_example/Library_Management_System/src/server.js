const express = require("express");
const app = express();
const port = 3000;
const path = require("path");
const hdbs = require("express-handlebars");

app.engine(
  "hbs",
  hdbs.engine({
    defaultLayout: "main",
    extname: "hbs",
  })
);
app.set("view engine", "hbs");
app.set("views", path.join(_dirname, "resoures", "views"));

app.listen(port, (err) => {
  if (err) {
    console.log(err);
  }
  console.log(`Listening on http://localhost:${port}`);
});
