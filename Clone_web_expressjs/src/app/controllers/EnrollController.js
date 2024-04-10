const User = require("../models/user.js");
const jwt = require("jsonwebtoken");
const { validationResult } = require("express-validator");
const jwtConfig = require("../../config/jwt");
class EnrollerController {
  page_sign_in(req, res) {
    res.render("./register_form/sign_in");
  }
  page_sign_up(req, res) {
    res.render("./register_form/sign_up");
  }
  // [Post] register
  async create_new_account(req, res, next) {
    const errors = validationResult(req);
    if (!errors.isEmpty()) {
      return res.status(422).json({
        code: 422,
        errors: errors.array(),
      });
    }

    try {
      const user = new User(req.body);
      const newUser = await user.save();
      res.render("register_form/sign_in");
    } catch (error) {
      console.log(error);
      res.status(400).send("Bad request");
    }
  }
  // [Post] /sign_in
  async login(req, res) {
    const user = await User.findOne({
      Name: req.body.UserName,
      Password: req.body.Password,
    });
    if (user) {
      const token = jwt.sign({ sub: user.id }, jwtConfig.secret, {
        expiresIn: jwtConfig.expiresIn,
      });
      res.json({
        data: { token },
      });
    } else {
      res.status(401).json({
        code: 401,
        message: "Unauthorized",
      });
    }
  }
  currentUser(req, res) {
    res.render("/home");
  }
}
module.exports = new EnrollerController();
