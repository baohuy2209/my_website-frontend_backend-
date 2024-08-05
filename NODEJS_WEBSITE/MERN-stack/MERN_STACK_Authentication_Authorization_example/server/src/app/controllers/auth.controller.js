const asyncHandler = require("express-async-handler");
const db = require("../models/index");
const User = db.user;
const Role = db.role;
const jwt = require("jsonwebtoken");
const bcrypt = require("bcrypt");
class AuthController {
  /*
        @desc Post a register 
        @route POST /api/auth/register 
        @access private
    */
  registerUser = asyncHandler(async (req, res) => {
    const { username, email, password } = req.body;
    // The fields: username, email, password don't allow to empty
    if (!username || !email || !password) {
      res.status(400);
      throw new Error("All fields are mandatory");
    }
    // End condition

    // Check if email's new user is duplicate with email's another user
    const userAvailable = await User.findOne({ email });
    if (userAvailable) {
      res.status(400);
      throw new Error("User already registered");
    }
    // hash password
    const hashedPassword = await bcrypt.hash(password, 10);
    const user = await User.create({
      username,
      email,
      password: hashedPassword,
    });
    if (user) {
      // check roles of user
      if (req.body.roles) {
        Role.find(
          {
            name: { $in: req.body.roles },
          },
          (err, roles) => {
            if (err) {
              res.status(500);
              throw new Error("Server error: ");
            }
            user.roles = roles.map((role) => role._id);
            user
              .save()
              .then((res) => {
                res.status(201).json({ _id: user.id, email: user.email });
              })
              .catch((err) => {
                res.status(500);
                throw new Error("Server error.");
              });
          }
        );
      }
    } else {
      res.status(400);
      throw new Error("User data us not valid");
    }
    res.json({
      message: "Register the user",
    });
  });
  /*
        @desc Post a register 
        @route POST /api/auth/register 
        @access private
    */
  loginUser = asyncHandler(async (req, res) => {
    const { email, password } = req.body;
    if (!email || !password) {
      res.status(400);
      throw new Error("All fields are mandatory");
    }
    const user = await User.findOne({
      email,
    });
    if (user && bcrypt.compareSync(password, user.password)) {
      const accessToken = jwt.sign(
        {
          user: {
            username: user.username,
            email: user.email,
            id: user.id,
          },
        },
        process.env.ACCESS_TOKEN_SECRET,
        {
          expiresIn: "15m",
          algorithm: "HS256",
          allowInsecureKeySizes: true,
        }
      );
      var authorities = [];
      for (let i = 0; i < user.roles.length; i++) {
        authorities.push("ROLE_" + user.roles[i].name.toUpperCase());
      }
      req.session.token = accessToken;
      res.status(200).send({
        id: user._id,
        username: user.username,
        email: user.email,
        roles: authorities,
      });
      res.status(200).json({ accessToken });
    } else {
      res.status(401);
      throw new Error("email or password is not valid");
    }
  });
  /*
        @desc Current user informtion 
        @route GET /api/auth/current 
        @access private 
   */
  currentUser = asyncHandler(async (req, res) => {
    res.json(req.user);
  });
  signout = async (req, res, next) => {
    try {
      req.session = null;
      return res.status(200).send({ message: "You've have been signed out !" });
    } catch (err) {
      next(err);
    }
  };
}
module.exports = new AuthController();
