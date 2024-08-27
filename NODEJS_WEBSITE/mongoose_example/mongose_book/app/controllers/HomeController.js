const Contact_us = require("../models/contact_us.model");
class HomeController {
  // @desc Home page
  // @route GET /api/home
  // @access private
  home = (req, res) => {
    res.render("home/home");
  };
  // @desc Contact form
  // @route GET /api/home/contact_us
  // @access private
  contact_us = (req, res) => {
    res.render("home/contact_us");
  };
  // @desc Store information about client contact
  // @route POST /api/home/contact_us
  // @access private
  store_contact = (req, res) => {
    const info = new Contact_us(req.body);
    info
      .save()
      .then(() => {
        res.redirect("/api/home");
      })
      .catch((err) => {
        res.status(500);
        throw new Error(err);
      });
  };
}
module.exports = new HomeController();
