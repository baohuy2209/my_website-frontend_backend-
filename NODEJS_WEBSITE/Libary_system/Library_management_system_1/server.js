const express = require("express");
const app = express();
const port = 3000;
const bodyParser = require("body-parser");
const db = require("./config/db/index");
const route = require("./routes/index.routes");
const hdbs = require("express-handlebars");
const path = require("path");
db.connect();
app.use(bodyParser.json());
app.use(
  bodyParser.urlencoded({
    extended: true,
  })
);
app.engine(
  "hbs",
  hdbs.engine({
    defaultLayout: "main",
    extname: "hbs",
  })
);
app.set("view engine", "hbs");
app.set("views", path.join(__dirname, "views"));
route(app);
app.listen(port, () => {
  console.log(`Listening on http://localhost:${port}`);
});
