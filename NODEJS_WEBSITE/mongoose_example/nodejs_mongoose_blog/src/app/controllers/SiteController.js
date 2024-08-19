const Course = require("../models/Course.model");
const { multipleMongooseToObject } = require("../../util/mongoose");
class SiteController {
  // [GET] /site/search/
  search(req, res) {
    res.render("search");
  }
  // [GET] /site/
  index(req, res, next) {
    Course.find({})
      .then((courses) => {
        res.render("home", {
          courses: multipleMongooseToObject(courses),
        });
      })
      .catch(next);
  }
}
module.exports = new SiteController();
