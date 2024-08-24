const config = require("../../config/auth.cofig");
const User = require("../models/user.model");
const Role = require("../models/role.model");
var jwt = require("jsonwebtoken");
var bcrypt = require("bcrypt");
class AuthController {
  // [POST] /api/auth/signup
  register = (req, res) => {
    const { username, email, password } = req.body;
    if (!username || !email || !password) {
      res.status(400);
      throw new Error("All fields are mandatory");
    }
    const user = new User({
      username: username,
      email: email,
      password: bcrypt.hashSync(password, 10),
    });
    req.body.roles = ["user"];
    user
      .save()
      .then((user) => {
        if (req.body.roles) {
          Role.find({
            name: { $in: req.body.roles },
          })
            .then((roles) => {
              user.roles = roles.map((role) => role._id);
              user
                .save()
                .then(() => {
                  res.redirect("/login");
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
        res.redirect("/login");
      })
      .catch((err) => {
        res.status(500);
        throw new Error(err);
      });
  };
  signin = (req, res) => {
    User.findOne({ username: req.body.username })
      .populate("roles", "-__v")
      .exec((err, user) => {
        if (err) {
          res.status(500);
          throw new Error(err);
        }
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
          throw new Error("Invalid password");
        }
        const token = jwt.sign({ id: user._id }, config.secret, {
          algorithm: "HS256",
          allowInsecureKeySizes: true,
          expiresIn: 86400,
        });
        var authorities = [];
        for (let i = 0; i < user.roles.length; i++) {
          authorities.push("ROLE_" + user.roles[i].name.toUpperCase());
        }
        req.session.token = token;
        res.status(200).redirect("/api");
      });
  };
  // [POST] /api/auth/signout
  signout = async (req, res, next) => {
    try {
      req.session = null;
      return res.status(200).send({ message: "You've been signed out !" });
    } catch (err) {
      next(err);
    }
  };
}
module.exports = new AuthController();
