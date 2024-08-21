const Employee = require("../models/employee.model");
const { mongooseToObject } = require("../../util/mongoose");
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
  edit(req, res) {
    Employee.findById(req.params.id)
      .then((employee) => {
        res.render("employees/edit", {
          employee: mongooseToObject(employee),
        });
      })
      .catch((err) => {
        res.status(403);
        throw new Error(err);
      });
  }
  // [PUT] /employee/:id
  update(req, res) {
    Employee.findByIdAndUpdate(req.params.id)
      .then((employee) => {
        res.render("employees/show", {
          employee: mongooseToObject(employee),
        });
      })
      .catch((err) => {
        res.status(403);
        throw new Error(err);
      });
  }
  // [PATCH] /employee/:id/restore
  restore(req, res) {
    Employee.restore({ _id: req.params.id })
      .then(() => {
        res.redirect("back");
      })
      .catch((err) => {
        res.status(500);
        throw new Error(err);
      });
  }
  // [DELETE] /:id
  destroy(req, res) {
    Employee.delete({ _id: req.params.id })
      .then(() => res.redirect("back"))
      .catch((err) => {
        res.status(500);
        throw new Error(err);
      });
  }
  // [DELETE] /:id/force
  forceDestroy(req, res) {
    Employee.deleteOne({ _id: req.params.id })
      .then(() => {
        res.redirect("back");
      })
      .catch((err) => {
        res.status(500);
        throw new Error(err);
      });
  }
  // [GET] /:slug
  showDetails(req, res) {
    Employee.findOne({ slug: req.params.slug })
      .then((employee) => {
        res.render("employees/show", {
          employee: mongooseToObject(employee),
        });
      })
      .catch((err) => {
        res.status(403);
        throw new Error(err);
      });
  }
}
module.exports = new EmployeeController();
