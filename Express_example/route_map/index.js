var escapehtml = require("escape-html");
const express = require("express");
var verbose = process.env.NODE_ENV !== "test";
const app = express();
const port = 3000;
app.map = function (a, route) {
  route = route || "";
  for (var key in a) {
    switch (typeof a[key]) {
      case "object":
        app.map(a[key], route + key);
        break;
      case "function":
        if (verbose) {
          console.log("%s %s", key, route);
        }
        app[key](route, a[key]);
        break;
    }
  }
};

var users = {
  list: function (req, res) {
    res.send("user list");
  },
  get: function (req, res) {
    res.send("user " + escapehtml(req.params.uid));
  },
  delete: function (req, res) {
    res.send("delete users");
  },
};

var pets = {
  list: function (req, res) {
    res.send("user" + escapehtml(req.params.uid) + "'s pets");
  },
  delete: function (req, res) {
    res.send(
      "delete" +
        escapehtml(req.params.uid) +
        "'s pet" +
        escapehtml(req.params.pid)
    );
  },
};

app.map({
  "/users": {
    get: users.lists,
    delete: users.delete,
    "/uid": {
      get: users.get,
      "/pets": {
        get: pets.list,
        "/:pid": {
          delete: pets.delete,
        },
      },
    },
  },
});
app.listen(port, () => {
  console.log(`Listening on http://localhost:${port}`);
});
