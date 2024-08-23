const asyncHandler = require("express-async-handler");
const User = require("../models/user.model");
const bcrypt = require("bcrypt");
const jwt = require("jsonwebtoken");
class UserController {
  /**
   * @desc Register a user
   * @route POST /api/users/register
   * @access public
   */
  registerUser = asyncHandler(async (req, res) => {
    const { username, email, password } = req.body;
    // check all fields in register form
    if (!username || !email || !password) {
      res.status(400);
      throw new Error("All fields are mandatory !");
    }
    // check the available user
    const userAvailable = await User.findOne({ email });
    if (userAvailable) {
      res.status(400);
      throw new Error("User already exists !");
    }
    // Hash password
    const hashedPassword = await bcrypt.hash(password, 10);
    console.log("Hashed password", hashedPassword);
    const user = await User.create({
      username,
      email,
      password: hashedPassword,
    });
    console.log(`User created ${user}`);
    if (user) {
      res.status(201).json({ _id: user.id, email: user.email });
    } else {
      res.status(400);
      throw new Error("User data is not valid");
    }
    res.json({ message: "Register the user" });
  });
  /**
   * @desc Login user
   * @route POST /api/users/login
   * @access public
   */
  loginUser = asyncHandler(async (req, res) => {
    const { email, password } = req.body;
    if (!email || !password) {
      res.status(400);
      throw new Error("All fields are mandatory");
    }
    const user = await User.findOne({ email });
    // comapare password with hashedpassword
    if (user && (await bcrypt.compare(password, user.password))) {
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
          expiresInd: "15m",
        }
      );
      res.json({ accessToken });
    } else {
      res.status(401);
      throw new Error("email or password is not valid");
    }
  });
  /**
   * @desc current user
   * @route POST /api/users/current
   * @access private
   */
  currentUser = asyncHandler(async (req, res) => {
    req.json(req.user);
  });
}
module.exports = new UserController();
