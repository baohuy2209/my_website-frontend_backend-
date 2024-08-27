const { multipleMongooseToObject } = require("../../util/mongoose");
const Book = require("../models/book.model");
class ManageBookController {
  // @desc show table managed book
  // @route GET /api/manage/stored/book
  // @access private
  stored(req, res, next) {
    Promise.all([Book.find({}), Book.countDocumentsDeleted()])
      .then(([books, deletedCount]) => {
        res.render("manage/store_book", {
          deletedCount,
          books: multipleMongooseToObject(books),
        });
      })
      .catch((err) => {
        next(err);
      });
  }
  // @desc show table trashed book
  // @route  GET /api/manage/trash/book
  // @access private
  trash(req, res) {
    Book.findDeleted({})
      .then((trashBooks) => {
        res.render("manange/trash_book", {
          books: multipleMongooseToObject(trashBooks),
        });
      })
      .catch((err) => {
        next(err);
      });
  }
}
module.exports = new ManageBookController();
