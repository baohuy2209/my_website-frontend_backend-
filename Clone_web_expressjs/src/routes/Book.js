const express = require("express");
const router = express.Router();
const bookController = require("../app/controllers/BookController.js");

// [Post] /post_book_reference (new reference book)
router.post("/post_book_reference", bookController.store_book);
// [Get] /create_new_book (render form to fill information about the new book)
router.get("/create_new_book", bookController.create_book);
// [GET] /:id/edit (render view to update book)
router.get("/:id/edit", bookController.edit_book);
router.put("/:id", bookController.update);
// [DELETE] /:id (soft delete the book)
router.delete("/:id", bookController.delete_book);
// [PATCH] /:id/restorebook (restore the book from the trash )
router.patch("/:id/restorebook", bookController.restore);
// [DELETE] /:id/force (delete really the boook when the book at the trash)
router.delete("/:id/force", bookController.delete_force);
// show details book
router.get("/:slug", bookController.show_detail_book);
router.post("/handle-form-actions", bookController.handle_form_action);
// [Get]
router.get("/", bookController.show_book);
module.exports = router;
