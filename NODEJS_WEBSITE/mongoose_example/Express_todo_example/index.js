/**
 * Khai báo thư viện express
 */
const express = require("express");
const app = express(); // khởi tạo một instance của express
const path = require("path"); // khai báo thư viện path
const engine = require("ejs-locals"); // khai báo engine local
// const favicon = require("serve-favicon");
const cookieParser = require("cookie-parser"); // sử dụng cookie-parser
const methodOverride = require("method-override");
const logger = require("morgan");
const errorHandler = require("errorhandler");
const db = require("./config/db/index");
const dotenv = require("dotenv");
dotenv.config();
const routes = require("./routes");
db.connect();
app.engine("ejs", engine);
const PORT = process.env.PORT || 3000;
app.set("views", path.join(__dirname, "views"));
app.set("view engine", "ejs");
// app.use(favicon(path.join(__dirname, "public", "favicon.ico")));
app.use(logger("dev"));
app.use(methodOverride("_method"));
app.use(cookieParser());
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(express.static(path.join(__dirname, "public")));

// Development only
if (app.get("env") === "development") {
  app.use(errorHandler());
}
app.use("/", routes);
app.use(require("./middleware/currentUser"));
app.listen(PORT, () => {
  console.log(`Listening on http://localhost:${PORT}`);
});
