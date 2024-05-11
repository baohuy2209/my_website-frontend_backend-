const Book = require("../models/Book");
const { multipleMongooseToObject } = require("../util/mongoose");
class BookController {
  index(req, res, next) {
    Promise.all([Book.find({}), Book.countDocumentsDeleted])
      .then(([books, deletedBook]) => {
        res.render("pages/home", {
          deletedBook,
          books: multipleMongooseToObject(books),
        });
      })
      .catch(next);
  }
  add_newbook(req, res, next) {
    const book = new Book(req.body);
    book
      .save()
      .then(() => res.redirect("/"))
      .catch((err) => {
        next(err);
      });
  }
  issue_book(req, res) {
    var requestedBookName = req.body.bookName;
    books.forEach((book) => {
      if (book.bookName === requestedBookName) {
        book.bookState = "Issued";
      }
    });
    res.render("pages/home", {
      data: books,
    });
  }
  return_book(req, res) {
    var requestedBookName = req.params.bookName;
    books.forEach((book) => {
      if (book.bookName == requestedBookName) {
        book.bookState = "Available";
      }
    });
    res.render("pages/home", {
      data: books,
    });
  }
  delete_book(req, res) {
    var requestedBookName = req.body.bookName;
    var j = 0;
    books.forEach((book) => {
      j = j + 1;
      if (book.bookName == requestedBookName) {
        books.splice(j - 1, 1);
      }
    });
    res.render("home", {
      data: books,
    });
  }
}
module.exports = new BookController();
