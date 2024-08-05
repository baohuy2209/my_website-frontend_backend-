const asyncHandler = require("express-async-handler");
const jwt = require("jsonwebtoken");
const db = require("../models/index");
const User = db.user;
const validateToken = asyncHandler(async (req, res, next) => {
  let token = req.session.token;
  let authHeader = req.headers.authorization || req.headers.Authorization;
  if (authHeader && authHeader.startsWith("Bearer")) {
    token = authHeader.split(" ")[1];
    jwt.verify(token, process.env.ACCESS_TOKEN_SECRET, (err, decoded) => {
      if (err) {
        res.status(401);
        throw new Error("User is not authorized");
      }
      // Decoded information contains about the user information, expiration of token, iat
      // console.log(decoded);
      req.user = decoded.user;
      next();
    });
    // In case, don't have token
    if (!token) {
      res.status(401);
      throw new Error("User is not authorized or token is missing");
    }
  }
});
const isAdmin = (req, res, next) => {
  User.findById(req.body._id).exec((err, user) => {
    if (err) {
      res.status(500);
      throw new Error("Server error!");
    }
    Role.find({ _id: { $in: user.roles } }, (err, roles) => {
      if (err) {
        res.status(500);
        throw new Error("Server error!");
      }
      let flag = false; // check if the user have the needed role
      for (let i = 0; i < roles.length; i++) {
        if (roles[i].name === "admin") {
          next();
          flag = true; // the user has needed role
          return;
        }
      }
      if (!flag) {
        res.status(403);
        throw new Error("Require admin role");
      }
    });
  });
};
const isModerator = (req, res, next) => {
  User.findById(req.body._id).exec((err, user) => {
    if (err) {
      res.status(500);
      throw new Error("Server error!");
    }
    Role.find({ _id: { $in: user.roles } }, (err, roles) => {
      if (err) {
        res.status(500);
        throw new Error("Server error!");
      }
      let flag = false; // check if the user have the needed role
      for (let i = 0; i < roles.length; i++) {
        if (roles[i].name === "admin") {
          next();
          flag = true; // the user has needed role
          return;
        }
      }
      if (!flag) {
        res.status(403);
        throw new Error("Require admin role");
      }
    });
  });
};
const authJwt = {
  validateToken,
  isAdmin,
  isModerator,
};
module.exports = authJwt;
