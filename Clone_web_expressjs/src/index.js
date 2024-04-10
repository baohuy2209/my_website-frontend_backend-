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
const SortMiddleware = require("./app/middleware/SortMiddleware.js");
const cors = require("cors");
const passport = require("passport");
const session = require("express-session");
const hash = require("pbkdf2-password")();
mongoose.set("strictQuery", false);

app.use(methodOverride("_method")); // override method
app.use(SortMiddleware); // use middleware
// connect db
db.connect();
// set static files
app.use(express.static(path.join(__dirname, "public")));
app.use(
  express.urlencoded({
    extended: true,
  })
);
app.use(
  session({
    resave: false,
    saveUninitialized: false,
    secret: "shhhh, very secret",
  })
);
// take others resources
var corsOptions = {
  origin: "http://localhost:8081",
};
app.use(cors(corsOptions));

app.use(express.json());
app.use(morgan("combined")); // use morgan
// use express-handlebars
app.engine(
  "hbs",
  hdbs.engine({
    defaultLayout: "main",
    extname: "hbs",
    helpers: require("./helpers/handlebars.js"), // require handlebars.js
  })
);
app.set("view engine", "hbs");
app.set("views", path.join(__dirname, "resources", "views")); // set view for website
// router
route(app);

//run app
app.listen(port, () => console.log(` Listening on http://localhost:${port} `));
