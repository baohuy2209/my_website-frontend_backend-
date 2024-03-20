const express = require("express");
const app = express();
const port = 3000;
const hdbs = require("express-handlebars");
const morgan = require("morgan");
const path = require("path");
const route = require("./routes/index.js");
const db = require("./config/db/index.js");
const methodOverride = require("method-override");
const mongoose = require("mongoose");
const SortMiddleware = require("./app/middlewares/SortMiddleware.js");
const cors = require("cors");
mongoose.set("strictQuery", false);

app.use(methodOverride("_method"));
app.use(SortMiddleware);
// connect db
db.connect();

app.use(express.static(path.join(__dirname, "public")));
app.use(
  express.urlencoded({
    extended: true,
  })
);

var corsOptions = {
  origin: "http://localhost:8081",
};
app.use(cors(corsOptions));

app.use(express.json());
app.use(morgan("combined"));
app.engine(
  "hbs",
  hdbs.engine({
    defaultLayout: "main",
    extname: "hbs",
    helpers: require("./helpers/handlebars.js"),
  })
);

app.set("view engine", "hbs");
app.set("views", path.join(__dirname, "resources", "views"));
route(app);
app.listen(port, () => console.log(` Listening on http://localhost:${port} `));
