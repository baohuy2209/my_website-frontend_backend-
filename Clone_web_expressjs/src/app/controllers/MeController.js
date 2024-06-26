const Book = require("../models/Book");
const Course = require("../models/course");
const { multipleMongooseToObject } = require("../../util/mongoose");
const { mongooseToObject } = require("../../util/mongoose");
class MeController {
  store_book(req, res, next) {
    Promise.all([Book.find({}), Book.countDocumentsDeleted()])
      .then(([books, deletedBook]) =>
        res.render("me/storeBook", {
          deletedBook,
          books: multipleMongooseToObject(books),
        })
      )
      .catch(next);
  }

  trash_book(req, res, next) {
    Book.findDeleted({})
      .then((books) => {
        res.render("me/trashBook", {
          books: multipleMongooseToObject(books),
        });
      })
      .catch(next);
  }

  store_course(req, res, next) {
    Promise.all([Course.find({}), Course.countDocumentsDeleted()])
      .then(([courses, deletedCourse]) => {
        res.render("me/storeCourse", {
          deletedCourse,
          courses: multipleMongooseToObject(courses),
        });
      })
      .catch(next);
  }

  trash_course(req, res, next) {
    Course.findDeleted({})
      .then((courses) => {
        res.render("me/trashCourse", {
          courses: multipleMongooseToObject(courses),
        });
      })
      .catch(next);
  }
}

module.exports = new MeController();
