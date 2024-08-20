const Employee = require("../models/employee.model");
class EmployeeController {
  // [GET] /employees/register
  create(req, res) {
    res.render("employees/create");
  }
  // [POST] /employee/store
  store(req, res) {
    const {
      name,
      email,
      age,
      position,
      salary,
      phonenumber,
      dob,
      code_resident,
    } = req.body;
    if (
      !name ||
      !email ||
      !age ||
      !position ||
      !salary ||
      !phonenumber ||
      !dob ||
      !code_resident
    ) {
      res.status(400);
      throw new Error("All fields had been fulfilled");
    }
    const number_fixed = 100;
    var random_number = Math.floor((Math.random() * number_fixed) % 7);
    req.body.image = `/image/avatar${random_number}`;
    const new_employee = new Employee(req.body);
    new_employee
      .save()
      .then(() => {
        res.redirect("/manage/stored/employee");
      })
      .catch((err) => {
        res.status(500);
        throw new Error(err);
      });
  }
  // [GET] /employee/:id/edit
  edit(req, res) {}
  // [PUT] /employee/:id
  update(req, res) {}
  // [PATCH] /employee/:id/restore
  restore(req, res) {}
  // [DELETE] /:id
  destroy(req, res) {}
  // [DELETE] /:id/force
  forceDestroy(req, res) {}
  // [GET] /:slug
  showDetails(req, res) {
    res.render("employees/show");
  }
}
module.exports = new EmployeeController();
