const Book = require("../models/book.model");
const Typebook = require("../models/type.model");
const { mongooseToObject } = require("../../util/mongoose");
class BookController {
  // @desc A form to push new book
  // @route GET /api/books/create
  // @access private
  create(req, res) {
    res.render("book/create");
  }
  // @desc Store new data to database
  // @route POST /api/books/create
  // @access private
  store(req, res) {
    const {
      name,
      number_of_pages,
      author,
      price,
      rating,
      number_book_selled,
      number_book_selling,
      description,
      image,
      number_consider,
      type,
    } = req.body;
    if (
      !name ||
      !number_of_pages ||
      !author ||
      !price ||
      !rating ||
      !number_book_selled ||
      !number_book_selled ||
      !number_book_selling ||
      !description ||
      !image ||
      !number_consider
    ) {
      res.status(400);
      throw new Error("All field are mandatory !!!");
    }
    const newbook = new Book({
      name,
      number_of_pages,
      author,
      price,
      rating,
      number_book_selled,
      number_book_selling,
      description,
      image,
      number_consider,
    });
    newbook
      .save()
      .then((book) => {
        if (type) {
          Typebook.findOne({ typebook: type }).then((type) => {
            book.type = type._id;
            book
              .save()
              .then(() => {
                res.redirect("/api/manage/stored/book");
              })
              .catch((err) => {
                res.status(500);
                throw new Error(err);
              });
          });
        }
      })
      .catch((err) => {
        res.status(500);
        throw new Error(err);
      });
  }
  // @desc Show each book
  // @route GET /api/books/:id
  // @access private
  showDetail(req, res) {
    Book.findById(req.params.id)
      .then((book) => {
        res.render("book/show", {
          book: mongooseToObject(book),
        });
      })
      .catch((err) => {
        res.status(404);
        console.log(err);
        throw new Error("Not found book");
      });
  }
  // @desc Form to update data
  // @route GET /api/books/update/:id/edit
  // @access private
  showUpdate(req, res) {
    Book.findById(req.params.id)
      .then((book) => {
        res.render("book/update", {
          book: mongooseToObject(book),
        });
      })
      .catch((err) => {
        res.status(404);
        console.log(err);
        throw new Error("Not found data !");
      });
  }
  // @desc Form to update data
  // @route PUT /api/books/update/:id
  // @access private
  update(req, res) {
    Book.findByIdAndUpdate(req.params.id)
      .then((book) => {
        res.render("book/show", {
          book: mongooseToObject(book),
        });
      })
      .catch((err) => {
        res.status(404);
        console.log(err);
        throw new Error("Not found data !");
      });
  }
  // @desc Soft Delete
  // @route DELETE /api/books/destroy/:id
  // @access private
  destroy(req, res) {
    Book.delete({ _id: req.params.id })
      .then(() => res.redirect("back"))
      .catch((err) => {
        res.status(404);
        console.log(err);
        throw new Error("Not found data !");
      });
  }
  // @desc Form to update data
  // @route PATCH /api/books/restore/:id
  // @access private
  restore(req, res) {
    Book.restore({ _id: req.params.id })
      .then(() => res.redirect("/api/manage/stored/book"))
      .catch(next);
  }
  forceDelete(req, res) {
    Book.deleteOne({ _id: req.params.id })
      .then(() => {
        res.redirect("back");
      })
      .catch((err) => {
        res.status(404);
        console.log(err);
        throw new Error("Not found data");
      });
  }
}
module.exports = new BookController();
