const express = require("express");
const router = express.Router();
const bookController = require("../app/controllers/BookController.js");

router.post("/post_book_reference", bookController.store_book);
router.get("/create_new_book", bookController.create_book);
router.get("/:id/edit", bookController.edit_book);
router.put("/:id", bookController.update);
router.delete("/:id", bookController.delete_book);
router.patch("/:id/restorebook", bookController.restore);
router.delete("/:id/force", bookController.delete_force);
router.get("/:slug", bookController.show_detail_book);
router.post("/handle-form-actions", bookController.handle_form_action);
router.get("/", bookController.show_book);
module.exports = router;
