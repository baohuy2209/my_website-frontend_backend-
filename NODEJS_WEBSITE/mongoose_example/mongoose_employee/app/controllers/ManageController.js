const Employee = require("../models/employee.model");
class ManageController {
  // [GET] /manage/stored/employee
  stored(req, res) {
    res.render("manage_employee/stored_employee");
  }
  // [GET] /manage/trash/employee
  trash(req, res) {
    res.render("manage_employee/trash_employee");
  }
}
module.exports = new ManageController();
