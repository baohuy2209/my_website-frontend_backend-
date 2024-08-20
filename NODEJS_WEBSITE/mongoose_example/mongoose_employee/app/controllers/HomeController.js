const Employee = require("../models/employee.model");
const { multipleMongooseToObject } = require("../../util/mongoose");
class HomeController {
  // [GET] /
  index(req, res) {
    Employee.find({})
      .then((employees) => {
        res.render("home/home", {
          employees: multipleMongooseToObject(employees),
        });
      })
      .catch((err) => {
        console.log("Error: ", err);
        res.status(500);
        throw new Error("Interval server error");
      });
  }
  // [GET] /about
  about(req, res) {
    res.render("home/about");
  }
  // [GET] /contact-us
  contact_us(req, res) {
    res.render("home/contact_us");
  }
}
module.exports = new HomeController();
