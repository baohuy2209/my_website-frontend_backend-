const express = require("express");
const router = express.Router();
const controller = require("../controllers/ContactController");
router.get("/", controller.getAllContact);
router.post("/", controller.create);
router.get("/:id", controller.getOne);
router.put("/:id", controller.update);
router.delete("/:id", controller.delete);
module.exports = router;
