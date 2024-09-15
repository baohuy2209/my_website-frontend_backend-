const User = require("../models/user.model");
const Role = require("../models/role.model");
var jwt = require("jsonwebtoken");
var bcrypt = require("bcrypt");
class AuthController {
  signup(req, res) {
    const { username, email, password } = req.body;
    req.body.roles = ["user"];
    if (!username || !email || !password) {
      res.status(400).json({ message: "All fields are mandatory!" });
    }
    const hashedPassword = bcrypt.hashSync(password, process.env.SALT);
    const user = new User({
      username,
      email,
      password: hashedPassword,
    });
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
                  res
                    .status(201)
                    .json({ message: "User created successfully!" });
                })
                .catch((error) => {
                  res.status(500).json({ message: error });
                  return;
                });
            })
            .catch((error) => {
              res.status(500).json({ message: error });
              return;
            });
        }
      })
      .catch((error) => {
        res.status(500).json({ message: error });
        return;
      });
  }
  signin(req, res) {
    const { username, password } = req.body;
    if (!username || !password) {
      res.status(400).json({ message: "All fields are mandatory!" });
    }
    User.findOne({ username: username })
      .then((user) => {
        if (!user) {
          return res.status(404).json({ message: "User not found!" });
        }
        var passwordIsvalid = bcrypt.compareSync(password, user.password);
        if (!passwordIsvalid) {
          return res.status(401).json({ message: "Invalid password!" });
        }
        const token = jwt.sign({ id: user._id }, process.env.VERIFY_TOKEN, {
          algorithm: "HS256",
          allowInsecureKeySizes: true,
          expiresIn: 86400,
        });
        var authories = [];
        Role.find({
          _id: { $in: user.roles },
        }),
          then((roles) => {
            for (let i = 0; i < roles.length; i++) {
              authories.push(roles[i].name.toUpperCase());
            }
            req.session.token = token;
            res.status(200).json({
              id: user._id,
              username: user.username,
              email: user.email,
              roles: authories,
            });
          }).catch((error) => {
            res.status(500).json({ message: error });
            return;
          });
      })
      .catch((error) => {
        res.status(500).json({ message: err });
        return;
      });
  }
}
module.exports = new AuthController();
