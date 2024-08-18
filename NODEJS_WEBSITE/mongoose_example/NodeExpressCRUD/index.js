const express = require("express");
const path = require("path");
const favicon = require("serve-favicon");
const logger = require("morgan");
const cookieParser = require("cookie-parser");
const bodyParser = require("body-parser");
const mongoose = require("mongoose");
const errorHandler = require("./middleware/errorHandler");
const dotenv = require("dotenv");
dotenv.config();
mongoose.Promise = global.Promise;
const PORT = process.env.PORT || 3000;
mongoose
  .connect("mongodb://localhost/employee")
  .then(() => console.log("connection succesful"))
  .catch((err) => console.error(err));
const routes = require("./routes/index.routes");
const users = require("./routes/users.routes");
const employees = require("./routes/employees.routes");
const app = express();

// view engine setup
app.set("views", path.join(__dirname, "views"));
app.set("view engine", "ejs");

// uncomment after placing your favicon in /public
// app.use(favicon(path.join(__dirname, "public", "favicon.ico")));
app.use(logger("dev"));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, "public")));
app.use("/", routes);
app.use("/users", users);
app.use("/employees", employees);

app.use((req, res, next) => {
  const err = new Error("Not found");
  err.status = 404;
  next(err);
});
app.use(errorHandler);
app.listen(PORT, () => {
  console.log(`App listening on http://localhost:${PORT}`);
});
