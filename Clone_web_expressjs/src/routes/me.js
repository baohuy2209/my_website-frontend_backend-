const express = require("express");
const router = express.Router();

const meController = require("../app/controllers/MeController");

// render the spage which store information book
router.get("/stored/books", meController.store_book);
// render the spage which store information about courses
router.get("/stored/courses", meController.store_course);
// page restores items [Book]
router.get("/trash/book", meController.trash_book);
// page restores items [Course]
router.get("/trash/course", meController.trash_course);

module.exports = router;
