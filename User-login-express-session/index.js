const express = require("express");
const session = require("express-session");
const route = require("./routes/index.routes");
var app = express();

app.use(
  session({
    secret: "keyboard cat",
    resave: false,
    saveUninitialized: true,
  })
);
app.use(express.urlencoded({ extended: false }));
route(app);
app.listen(3000, () => {
  console.log(`Listening on http://localhost:3000`);
});
