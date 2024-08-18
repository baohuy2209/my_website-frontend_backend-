const express = require("express");
const router = express.Router();
const employee = require("../controllers/EmployeeController.js");

// [GET] all employees
router.get("/", employee.list);
// [GET] single employee by id
router.get("/show/:id", employee.show);
// [GET] create employee
router.get("/create", employee.create);
// [POST] save employee
router.post("/save", employee.save);
// [GET] edit employee
router.get("/edit/:id", employee.edit);
// [POST] update employee
router.put("/update/:id", employee.update);
// [DELETE] delete 1 employee
router.delete("/delete/:id", employee.deleteById);
module.exports = router;
// https://github.com/didinj/NodeExpressCRUD/blob/master/controllers/EmployeeController.js
