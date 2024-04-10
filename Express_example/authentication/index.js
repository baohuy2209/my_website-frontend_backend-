var express = require("express");
var path = require("path");
var hash = require("pbkdf2-password")();
var session = require("express-session");
var app = express();
//config
app.set("view engine", "ejs");
app.set("views", path.join(__dirname, "views"));

//middleware
app.use(express.urlencoded({ extended: false }));
app.use(
  session({
    resave: false,
    saveUninitialized: false,
    secret: "shhhh, very secret",
  })
);
hash({ password: "foobar" }, function (err, pass, salt, hash) {
  if (err) throw err;
  // store the salt & hash in the "db"
  users.tj.salt = salt;
  users.tj.hash = hash;
});
// Session-persisted message middleware
app.use(function (req, res, next) {
  var err = req.session.error;
  var msg = req.session.success;
  delete req.session.error;
  delete req.session.success;
  res.locals.message = "";
  if (err) {
    res.locals.message = '<p class="msg error">' + err + "</p>";
  }
  if (msg) {
    res.locals.message = '<p class="msg success">' + msg + "</p>";
  }
  next();
});
//dummy database
var users = {
  tj: { name: "huy" },
};

// when you create a user, generate a salt and hash the password ('foobar' is the pass here)
function authenticate(name, pass, fn) {
  if (!module.parent) {
    console.log("authenticating %s:%s", name, pass);
  }
  var user = users[name];
  if (!user) {
    return fn(null, null);
  }
  hash({ password: pass, salt: user.salt }, function (err, pass, salt, hash) {
    if (err) {
      return fn(err);
    }
    if (hash === user.hash) {
      return fn(null, user);
    }
    fn(null, null);
  });
}

function restrict(req, res, next) {
  if (req.session.user) {
    next();
  } else {
    req.session.error = "Access denied!";
    res.redirect("/login");
  }
}

app.get("/", function (req, res) {
  res.redirect("/login");
});
app.get("/restricted", restrict, function (req, res) {
  res.send('Wahoo! restricted area, click to <a href="/logout">logout</a>');
});
app.get("logout", function (req, res) {
  req.session.destroy(function () {
    res.redirect("/");
  });
});
app.post("/login", function (req, res, next) {
  authenticate(req.body.username, req.body.password, function (err, user) {
    if (err) {
      return next(err);
    }
    if (user) {
      req.session.regenerate(function () {
        req.session.user = user;
        req.session.success =
          "Authenticated as " +
          user.name +
          ' click to <a href="/logout">logout</a>. ' +
          ' You may now access <a href="/restricted">/restricted</a>.';
        res.redirect("back");
      });
    } else {
      req.session.error =
        "Authentication failed, please check your " +
        " username and password." +
        ' (use "tj" and "foobar")';
      res.redirect("/login");
    }
  });
});
app.get("/login", function (req, res) {
  res.render("login");
});
app.listen(8080, () => {
  console.log(`Listening on http://localhost:8080`);
});
