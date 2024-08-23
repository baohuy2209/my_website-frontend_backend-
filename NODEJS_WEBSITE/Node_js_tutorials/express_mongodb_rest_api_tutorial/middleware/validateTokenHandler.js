const asyncHandler = require("express-async-handler");
const jwt = require("jsonwebtoken");
const validateToken = asyncHandler(async (req, res, next) => {
  let token;
  let authHeader = req.headers.Authorization || req.headers.authorization;
  if (authHeader && authHeader.startWith("Bearer")) {
    token = authHeader.split(" ")[1];
    // verify token
    jwt.verify(token, process.env.ACCESS_TOKEN_SECRET, (err, decoded) => {
      if (err) {
        res.status(401);
        throw new Error("User is not authorized");
      }
      req.user = decoded.user; // render current user when verifying token is successful
      next();
    });
    if (!token) {
      res.status(401);
      throw new Error("User is not authorized or token is missing");
    }
  }
});
module.exports = validateToken;
