const express = require("express");
const router = express.Router();
const controller = require("../controllers/TutorialsController");
router.get("/", controller.getAll);
router.get("/:id", controller.getOne);
router.post("/", controller.create);
router.put("/:id", controller.update);
router.delete("/", controller.deleteAll);
router.delete("/:id", controller.deleteOne);
router.get("/search", controller.searchByTitle);
module.exports = router;
