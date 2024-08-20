const express = require("express");
const app = express();
const handlebars = require("express-handlebars");
const dotenv = require("dotenv");
const path = require("path");
dotenv.config();
const PORT = process.env.PORT || 3001;
app.engine(
  "hbs",
  handlebars.engine({
    extname: ".hbs",
    helpers: {
      sum: (a, b) => a + b,
    },
  })
);
app.set("view engine", "handlebars");
app.set("views", path.join(__dirname, "./resources/views"));
app.listen(PORT, () => {
  console.log(`Listening on http://localhost:${PORT}`);
});
