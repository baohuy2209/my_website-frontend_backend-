const Course = require("../models/course.js");
const { multipleMongooseToObject } = require("../../util/mongoose.js");
const { mongooseToObject } = require("../../util/mongoose.js");
class CourseController {
  create_new_course(req, res) {
    res.render("./Courses/create_course.hbs");
  }

  show_course(req, res, next) {
    Course.find({})
      .then((courses) => {
        res.render("./Courses/courses.hbs", {
          courses: multipleMongooseToObject(courses),
        });
      })
      .catch(next);
  }
  show_detail_course(req, res, next) {
    Course.findOne({ slug: req.params.slug })
      .then((course) => {
        res.render("./Courses/show_detail_course", {
          course: mongooseToObject(course),
        });
      })
      .catch(next);
  }
  store_course(req, res, next) {
    const format = req.body;
    const course = new Course(format);
    course
      .save()
      .then(() => res.redirect("/me/stored/courses"))
      .catch((error) => {
        next(error);
      });
  }
  edit_course(req, res, next) {
    Course.findById(req.params.id)
      .then((course) =>
        res.render("./Courses/edit_course", {
          course: mongooseToObject(course),
        })
      )
      .catch(next);
  }
  update_course(req, res, next) {
    Course.upddateOne({ _id: req.params.id }, req.body)
      .then(() => res.redirect("me/stored/courses"))
      .catch(next);
  }
  delete_course() {
    Course.delete({ _id: req.params.id })
      .then(() => res.redirect("back"))
      .catch(next);
  }
  add_benefit_field() {}
  handle_form_action(req, res, next) {}
}
module.exports = new CourseController();
