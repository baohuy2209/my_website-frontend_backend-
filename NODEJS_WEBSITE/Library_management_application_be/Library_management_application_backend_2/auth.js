//auth.js

const jwt = require("jsonwebtoken");
const JWTStrategy = require("passport-jwt").Strategy;
var LocalStrategy = require("passport-local");
var passport = require("passport");
const express = require("express");
var router = express.Router();
var { User } = require("./db");

//passport local strategy configuration
passport.use(
  new LocalStrategy(async function verify(username, password, cb) {
    const query = User.where({ username: username });
    await query
      .findOne()
      .then(function (user) {
        if (user.password === password) {
          cb(null, user, { status: 200, message: "Login Successful." });
        } else {
          cb(null, false, {
            status: 401,
            message: "Incorrect username or password.",
          });
        }
      })
      .catch(function (err) {
        cb(null, false, { status: 401, message: "User Does Not Exist" });
      });
  })
);

//passport jwt strategy configuration
passport.use(
  new JWTStrategy(
    {
      jwtFromRequest: (req) => req.headers["x-access-token"],
      secretOrKey: "examplesecret",
    },
    (payload, done) => {
      return done(null, payload);
    }
  )
);

passport.serializeUser(function (user, cb) {
  process.nextTick(function () {
    cb(null, { id: user.id, username: user.username });
  });
});

passport.deserializeUser(function (user, cb) {
  process.nextTick(function () {
    return cb(null, user);
  });
});

//route for registering user and admin
router.post("/register", async (req, res) => {
  //new user creation from request body data
  var user1 = new User(req.body);

  await user1.save().then(
    function (user) {
      if (user) {
        console.log(user.name + " saved to user collection.");
        res.send({ status: 200, message: user.name });
      }
    },
    function (err) {
      //errors for various primary key
      if (Object.keys(err.keyPattern)[0] == "mobile") {
        res.send({ status: 500, message: "User with mobile already exist" });
      } else if (Object.keys(err.keyPattern)[0] == "username") {
        res.send({ status: 500, message: "User with username already exist" });
      } else if (Object.keys(err.keyPattern)[0] == "email") {
        res.send({ status: 500, message: "User with email already exist" });
      } else {
        res.send({ status: 500, message: "Internal Server Error" });
      }
    }
  );
});

//route for logging user in
router.post("/login", (req, res) => {
  passport.authenticate("local", { session: false }, (err, user, info) => {
    if (err || !user) {
      return res.send({ status: 401, message: info.message });
    }
    req.login(user, { session: false }, (err) => {
      if (err) {
        res.send(err);
      }
      var userobject = {
        username: user.username,
        mobile: user.mobile,
        admin: user.admin,
      };
      var token = jwt.sign(userobject, "examplesecret");
      req.session.jwt = token;
      return res.send({ status: 200, token: token });
    });
  })(req, res);
});

//route for logging out user
router.post("/logout", (req, res, next) => {
  req.session.destroy(function (err) {
    if (err) {
      return next(err);
    }
    res.redirect("/");
  });
});

//route for getting session in frontend
router.get("/session", (req, res) => {
  passport.authenticate("jwt", { session: false }, (err, user) => {
    if (err || !user) {
      res.send(false);
    } else {
      res.send(user);
    }
  })(req, res);
});

module.exports = router;
