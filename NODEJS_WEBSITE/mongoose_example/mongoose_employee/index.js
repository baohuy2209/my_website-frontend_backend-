const express = require("express");
const app = express();
const handlebars = require("express-handlebars");
const dotenv = require("dotenv");
const path = require("path");
dotenv.config();
const PORT = process.env.PORT || 3001;
const logger = require("morgan");
const errrorHandler = require("./app/middleware/errorHandler");
const db = require("./config/db/index");
const route = require("./routes/index.routes");
const mongoose = require("mongoose");
const errorHandler = require("./app/middleware/errorHandler");
mongoose.set("strictQuery", false);
db.connectDB();
app.engine(
  "hbs",
  handlebars.engine({
    extname: ".hbs",
    helpers: {
      sum: (a, b) => a + b,
    },
  })
);
app.use(logger("combined"));
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(errorHandler);
app.use(express.static(path.join(__dirname, "public")));
app.set("view engine", "hbs");
app.set("views", path.join(__dirname, "./resources/views"));

route(app);
app.listen(PORT, () => {
  console.log(`Listening on http://localhost:${PORT}`);
});
