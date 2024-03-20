const express = require("express");
const router = express.Router();
const coursesController = require("../app/controllers/CourseController");

router.get("/create_new_course", coursesController.create_new_course);
router.post("/post_course", coursesController.store_course);
router.get("/:id/edit", coursesController.edit_course);
router.get("/:slug", coursesController.show_detail_course);
router.put("/:id", coursesController.update_course);
router.delete("/:id", coursesController.delete_course);
router.post("/handle-form-actions", coursesController.handle_form_action);
router.get("/", coursesController.show_course);
module.exports = router;
