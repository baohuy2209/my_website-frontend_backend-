const config = require("../../config/auth.config");
const User = require("../models/user.model");
const Role = require("../models/role.model");
var jwt = require("jsonwebtoken");
var bcrypt = require("bcrypt");
var showHeaderFooter = require("../../helpers/showHeaderFooter");
class AuthController {
  // @desc Register
  // @route POST /api/auth/signup
  // @access private
  register = (req, res, next) => {
    const {
      username,
      email,
      password,
      rewrite_password,
      day,
      month,
      year,
      phonenumber,
      gender,
      address,
    } = req.body;
    if (password != rewrite_password) {
      res.status(401);
      throw new Error("Confirm password failed !");
    }
    if (
      !username ||
      !email ||
      !password ||
      !day ||
      !month ||
      !year ||
      !phonenumber ||
      !gender ||
      !address
    ) {
      res.status(400);
      throw new Error("All fields are mandatory");
    }
    req.body.roles = ["user"];
    const avatar = "";
    const dob = new Date(`${year}-${month}-${day}`).toString();
    const hashedPassword = bcrypt.hashSync(password, 8);
    var currentYear = new Date().getFullYear();
    const age = Number(currentYear) - Number(year);
    const user = new User({
      username,
      email,
      password: hashedPassword,
      avatar,
      dob,
      age,
      phonenumber,
      gender,
      address,
    });
    user
      .save()
      .then((user) => {
        if (req.body.roles) {
          Role.find({ name: { $in: req.body.roles } })
            .then((roles) => {
              user.roles = roles.map((role) => role._id);
              user
                .save()
                .then(() => {
                  res.redirect("/api/home");
                })
                .catch((err) => {
                  res.status(500);
                  throw new Error(err);
                });
            })
            .catch((err) => {
              res.status(500);
              throw new Error(err);
            });
        }
        showHeaderFooter(true);
        res.redirect("/api/home");
      })
      .catch((err) => {
        res.status(500);
        throw new Error(err);
      });
  };
  // @desc Signin
  // @route POST /api/auth/signin
  // @access private
  signin = (req, res) => {
    User.findOne({ username: req.body.username })
      .then((user) => {
        if (!user) {
          res.status(500);
          throw new Error("User not found");
        }
        var passwordIsValid = bcrypt.compareSync(
          req.body.password,
          user.password
        );
        if (!passwordIsValid) {
          res.status(401);
          throw new Error("Invalid Password!");
        }
        const token = jwt.sign({ id: user.id }, config.secret, {
          algorithm: "HS256",
          allowInsecureKeySizes: true,
          expiresIn: 86400,
        });
        var authorities = [];
        for (let i = 0; i < user.roles.lengthl; i++) {
          authorities.push("ROLE_" + user.roles[i].name.toUpperCase());
        }
        req.session.token = token;
        showHeaderFooter(true);
        res.redirect("/api/home");
      })
      .catch((err) => {
        res.status(500);
        throw new Error(err);
      });
  };
  // @desc signout
  // @route POST /api/auth/signout
  // @access private
  signout = async (req, res) => {
    try {
      res.session = null;
      showHeaderFooter(false);
      return res.redirect("/api/login");
    } catch (err) {
      this.next(err);
    }
  };
}
module.exports = new AuthController();
