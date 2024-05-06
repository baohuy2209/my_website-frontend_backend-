const books = [
  {
    bookName: "Rudest Book Ever",
    bookAuthor: "Shwetabh Gangwar",
    bookPages: 200,
    bookPrice: 240,
    bookState: "Available",
  },
  {
    bookName: "Do Epic Shit",
    bookAuthor: "Ankur Wariko",
    bookPages: 200,
    bookPrice: 240,
    bookState: "Available",
  },
];
const Book = require("../models/Book");
class BookController {
  index(req, res) {
    res.render("pages/home", { data: books });
  }
  add_newbook(req, res) {
    const inputBookName = req.body.bookName;
    const inputBookAuthor = req.body.bookAuthor;
    const inputBookPages = req.body.bookPages;
    const inputBookPrice = req.body.bookPrice;

    books.push({
      bookName: inputBookName,
      bookAuthor: inputBookAuthor,
      bookPages: inputBookPages,
      bookPrice: inputBookPrice,
      bookState: "Available",
    });

    res.render("home", {
      data: books,
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
