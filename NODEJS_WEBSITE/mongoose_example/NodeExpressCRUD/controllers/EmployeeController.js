const asyncHandler = require("express-async-handler");
const mongoose = require("mongoose");
const Employee = require("../models/Employee");
class EmployeeController {
  // [GET] all employees
  // private path
  list = asyncHandler(async (req, res) => {
    await Employee.find({}).exec((err, employees) => {
      if (err) {
        console.log("Error: ", err);
        res.status(404);
        throw new Error("Employee data is not valid");
      } else {
        res.render("../views/employees/index", { employees: employees });
      }
    });
  });
  // [GET] single employee by id
  // private path
  show = asyncHandler(async (req, res) => {
    await Employee.findOne({ _id: req.params.id }).exec((err, employee) => {
      if (err) {
        console.log("Error: ", err);
        res.status(404);
        throw new Error("Not found");
      } else {
        res.render("../views/employees/show", { employee: employee });
      }
    });
  });
  // [GET] create employee
  // private path
  create = asyncHandler(async (req, res) => {
    res.render("../views/employees/create.ejs");
  });
  // [GET] save information to database
  // private path
  save = asyncHandler(async (req, res) => {
    const employee = new Employee(req.body);
    await employee.save((err) => {
      if (err) {
        console.log(err);
        res.render("../views/employees/create.ejs");
      } else {
        console.log("Successfully created an employee. ");
        res.redirect("/employees/show/" + employee._id);
      }
    });
  });
  // [GET] edit information of employee
  // private path
  edit = asyncHandler(async (req, res) => {
    await Employee.findOne({ _id: req.params.id }).exec((err, employee) => {
      if (err) {
        console.log("Error: ", err);
        res.status(500);
        throw new Error("Server error !!!");
      } else {
        res.render("../views/employees/edit");
      }
    });
  });
  // [GET] single employee by id
  // private path
  update = asyncHandler(async (req, res) => {
    await Employee.findByIdAndUpdate(
      req.params.id,
      {
        $set: {
          name: req.body.name,
          address: req.body.address,
          position: req.body.position,
          salary: req.body.salary,
        },
      },
      { new: true },
      function (err, employee) {
        if (err) {
          console.log(err);
          res.render("../views/employees/edit.ejs", { employee: req.body });
        }
        res.redirect("/employees/show/" + employee._id);
      }
    );
  });
  // [DELETE] delete employee by Id
  // private path
  deleteById = asyncHandler(async (req, res) => {
    await Employee.remove({ _id: req.params.id }, (err) => {
      if (err) {
        console.log(err);
      } else {
        console.log("Employee deleted!");
        res.redirect("/employees");
      }
    });
  });
}
module.exports = new EmployeeController();
