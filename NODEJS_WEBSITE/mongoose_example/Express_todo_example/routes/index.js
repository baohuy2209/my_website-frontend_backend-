const express = require("express");
const router = express.Router();
const todoController = require("../controllers/TodoController");
// [GET] / to get entire todo command
router.get("/", todoController.index);
router.post("/create", todoController.create);
router.delete("/delete/:id", todoController.deleteById);
router.get("/edit/:id", todoController.edit);
router.put("/update/:id", todoController.update);
module.exports = router;
