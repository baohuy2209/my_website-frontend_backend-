var express = require("express");
var app = express();
const PORT = 8080;

// function handle error
function error(status, msg) {
  var err = new Error(msg);
  err.status = status;
  return err;
}
// [GET] /api
app.use("/api", function (req, res, next) {
  // get key from requests
  var key = req.query["api-key"];
  // check if doesn't any key
  if (!key) {
    return next(error(400, "api key required"));
  }
  // check exists key in apiKeys
  if (apiKeys.indexOf(key) === -1) {
    return next(error(401, "invalid api key"));
  }
  // assign key to request
  req.key = key;
  next();
});
// create array of apiKeys
var apiKeys = ["foo", "bar", "baz"];
// create repos contains objects which have two fields name and url
var repos = [
  { name: "express", url: "https://github.com/expressjs/express" },
  { name: "stylus", url: "https://github.com/learnboost/stylus" },
  { name: "cluster", url: "https://github.com/learnboost/cluster" },
];
// array users
var users = [{ name: "tobi" }, { name: "loki" }, { name: "jane" }];
// create repos
var userRepos = {
  tobi: [repos[0], repos[1]],
  loki: [repos[1]],
  jane: [repos[2]],
};

app.get("/api/users", function (req, res) {
  res.send(users);
});

app.get("/api/repos", function (req, res) {
  res.send(repos);
});
app.get("/api/user/:name/repos", function (req, res, next) {
  var name = req.params.name;
  var user = userRepos[name];
  if (user) {
    res.send(user);
  } else {
    next();
  }
});

app.use(function (err, req, res, next) {
  res.status(err.status || 500);
  res.send({ error: err.message });
});

app.use(function (req, res) {
  res.status(404);
  res.send({ error: "Sorry, can't find that" });
});

app.listen(PORT, () => {
  console.log(`Server listening on port http://localhost:${PORT}`);
});
