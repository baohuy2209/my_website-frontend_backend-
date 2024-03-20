class Getting_started_Controller {
  render_installing(req, res, next) {
    res.render("./Getting_started/Installing");
  }

  render_hello_world(req, res, next) {
    res.render("./Getting_started/Hello_world_example");
  }

  render_Express_generator(req, res, next) {
    res.render("./Getting_started/Express_application_generator");
  }

  render_Basic_routing(req, res, next) {
    res.render("./Getting_started/Basic_routing");
  }
  render_Static_files(req, res, next) {
    res.render("./Getting_started/Serving_static_files_in_Express");
  }
  render_More_examples(req, res, next) {
    res.render("./Getting_started/Express_example");
  }

  render_FAQ(req, res, next) {
    res.render("./Getting_started/FAQ");
  }
}

module.exports = new Getting_started_Controller();
