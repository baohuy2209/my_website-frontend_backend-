const Book = require("../models/Book.js");
const { multipleMongooseToObject } = require("../../util/mongoose.js");
const { mongooseToObject } = require("../../util/mongoose.js");
class BookController {
  create_book(req, res) {
    res.render("./Book/create_book");
  }
  show_book(req, res, next) {
    Book.find({})
      .then((books) => {
        res.render("./Book/book", {
          books: multipleMongooseToObject(books),
        });
      })
      .catch(next);
  }

  store_book(req, res, next) {
    const format = req.body;
    const book = new Book(format);
    book
      .save()
      .then(() => res.redirect("/me/stored/book"))
      .catch((error) => {
        next(error);
      });
  }
  show_detail_book(req, res, next) {
    Book.findOne({ slug: req.params.slug })
      .then((book) => {
        res.render("./Book/show_detail_book", {
          book: mongooseToObject(book),
        });
      })
      .catch(next);
  }
  edit_book(req, res, next) {
    Book.findById(req.params.id)
      .then((book) =>
        res.render("./Book/edit_book", {
          book: mongooseToObject(book),
        })
      )
      .catch(next);
  }
  update(req, res, next) {
    Book.updateOne({ _id: req.params.id }, req.body)
      .then(() => res.redirect("/me/stored/book"))
      .catch(next);
  }
  delete_book(req, res, next) {
    Book.delete({ _id: req.params.id })
      .then(() => res.redirect("back"))
      .catch(next);
  }
  restore(req, res, next) {
    Book.restore({ _id: req.params.id })
      .then((book) => {
        res.redirect("back");
      })
      .catch((error) => {
        next(error);
      });
  }
  delete_force(req, res, next) {
    Book.deleteOne({ _id: req.params.id })
      .then(() => res.redirect("back"))
      .catch((error) => {
        next(error);
      });
  }
  handle_form_action(req, res, next) {
    switch (req.body.action) {
      case "Delete":
        Book.delete({ _id: { $in: req.body.bookIds } })
          .then(() => res.redirect("back"))
          .catch(next);

        break;
      default:
        res.json({ message: "Action is invalid" });
        break;
    }
  }
}

module.exports = new BookController();
