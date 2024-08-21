const Employee = require("../models/employee.model");
const { multipleMongooseToObject } = require("../../util/mongoose");
class ManageController {
  // [GET] /manage/stored/employee
  stored(req, res) {
    Promise.all([Employee.find({}), Employee.countDocumentsDeleted()])
      .then(([employees, deletedCount]) => {
        res.render("manage_employee/stored_employee", {
          deletedCount,
          employees: multipleMongooseToObject(employees),
        });
      })
      .catch((err) => {
        res.status(401);
        throw new Error(err);
      });
  }
  // [GET] /manage/trash/employee
  trash(req, res) {
    Employee.findDeleted()
      .then((employees) => {
        res.render("manage_employee/trash_employee", {
          employees: multipleMongooseToObject(employees),
        });
      })
      .catch((err) => {
        res.status(403);
        throw new Error(err);
      });
  }
}
module.exports = new ManageController();
