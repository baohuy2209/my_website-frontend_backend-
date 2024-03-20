const express = require("express");
const router = express.Router();

const meController = require("../app/controllers/MeController");

router.get("/stored/books", meController.store_book);
router.get("/stored/courses", meController.store_course);
router.get("/trash/book", meController.trash_book);
router.get("/trash/course", meController.trash_course);

module.exports = router;
