const express = require("express");
const app = express();
const dotenv = require("dotenv");
dotenv.config();
const logger = require("morgan");
app.use(logger("combined"));
const methodOverride = require("method-override");
const handlebars = require("express-handlebars");
const route = require("./routes");
const db = require("./config/db");
const mongoose = require("mongoose");
mongoose.set("strictQuery", false);
db.connect();
const path = require("path");
const PORT = process.env.PORT || 3000;
app.use(express.static(path.join(__dirname, "public")));
app.use(express.urlencoded({ extended: true }));
app.use(methodOverride("_method"));
const hbs = handlebars.create({
  extname: ".hbs",
  helpers: {
    sum: (a, b) => a + b,
  },
});
app.engine("hbs", hbs.engine);
app.set("view engine", "hbs");
app.set("views", path.join(__dirname, "./resources/views"));
route(app);
app.listen(PORT, () => {
  console.log(`Listening on http://localhost:${PORT}`);
});
