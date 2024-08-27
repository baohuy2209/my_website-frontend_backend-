const express = require("express");
const app = express();
const dotenv = require("dotenv");
const logger = require("morgan");
const errorHandler = require("./app/middleware/errorHandler");
const route = require("./routes/index.routes");
const handlebars = require("express-handlebars");
const path = require("path");
const cookieSession = require("cookie-session");
const { getAuthenticated } = require("./constants/isAuthenticated");
app.set("view engine", "hbs");
app.use(
  cookieSession({
    name: "baohuy",
    keys: ["COOKIE-SECRET"],
    httpOnly: true,
  })
);
app.engine(
  "hbs",
  handlebars.engine({
    extname: ".hbs",
    helper: require("./helpers/helpers"),
  })
);
app.use(express.urlencoded({ extended: true }));
app.use(express.json());
app.use(express.static(path.join(__dirname, "public")));
app.set("views", path.join(__dirname, "./resources/views"));
app.use(logger("dev"));
app.use(errorHandler);
const db = require("./config/db/connect");
dotenv.config();
db.connectDB();
const PORT = process.env.PORT || 5001;
route(app);

app.listen(PORT, () => {
  console.log(`Listening on http://localhost:${PORT}/api/login`);
});
