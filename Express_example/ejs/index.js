var express = require("express");
var path = require("path");
const port = 3000;
var app = express();
app.engine("./html", require("ejs").__express);
app.set("views", path.join(__dirname, "views"));
app.use(express.static(path.join(__dirname, "public")));

app.set("view engine", "html");

var users = [
  { name: "tobi", email: "tobi@learnboost.com" },
  { name: "loki", email: "loki@learnboost.com" },
  { name: "jane", email: "jane@learnboost.com" },
];
app.get("/", function (req, res) {
  res.render("users", {
    users: users,
    title: "EJS example",
    header: "some users",
  });
});

app.listen(port, () => {
  console.log(`Listening on http://localhost:${port}`);
});
