const express = require("express");
const session = require("express-session");
const route = require("./routes/index.routes");
const path = require("path");
const hdbs = require("express-handlebars");
const morgan = require("morgan");
const cors = require("cors");
const db = require("./app/config/db/index.js");
var app = express();

app.use(
  session({
    secret: "keyboard cat",
    resave: false,
    saveUninitialized: true,
  })
);

app.use(express.static(path.join(__dirname, "public")));
app.use(express.urlencoded({ extended: false }));
var corsOptions = {
  origin: "https://localhost:8081",
};
app.use(cors(corsOptions));
app.use(express.json());
app.use(morgan("combined"));
db.connect();
app.engine(
  "hbs",
  hdbs.engine({
    defaultLayout: "main",
    extname: "hbs",
  })
);
app.set("view engine", "hbs");
app.set("views", path.join(__dirname, "resources", "views"));
route(app);
app.listen(3000, () => {
  console.log(`Listening on http://localhost:3000`);
});
