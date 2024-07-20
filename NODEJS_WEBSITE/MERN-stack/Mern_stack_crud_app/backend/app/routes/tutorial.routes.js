const express = require("express");
const router = express.Router();
const controller = require("../controllers/tutorial.controller");
router.get("/find_by_title", controller.findAllPuslished);
router.get("/:id", controller.findOne);
router.post("/", controller.create);
router.put("/:id", controller.update);
router.delete("/:id", controller.delete);
router.delete("/", controller.deleteAll);
router.get("/", controller.findAll);

module.exports = router;
