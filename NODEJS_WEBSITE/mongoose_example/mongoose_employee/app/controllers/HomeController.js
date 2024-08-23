const Employee = require("../models/employee.model");
const { multipleMongooseToObject } = require("../../util/mongoose");
const Contact = require("../models/contact.model");
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
    res.render("home/weather");
  }
  // [POST] /about
  getContact(req, res) {
    const contact = new Contact(req.body);
    contact
      .save()
      .then(() => res.redirect("back"))
      .catch((err) => {
        console.log(err);
        res.status(500);
        throw new Error(JSON.stringify(err));
      });
  }
  // [GET] /contact-us
  contact_us(req, res) {
    res.render("home/contact_us");
  }
}
module.exports = new HomeController();
