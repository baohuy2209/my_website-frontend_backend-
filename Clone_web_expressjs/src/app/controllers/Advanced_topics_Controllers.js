class Advanced_topics_Controller {
  Template_engines(req, res, next) {
    res.render("./advances_topics/Template_engines");
  }

  Process_managers(req, res) {
    res.render("./advances_topics/Process_managers");
  }

  Security_updates(req, res) {
    res.render("./advances_topics/Security_updates");
  }

  Security_best_practices(req, res) {
    res.render("./advances_topics/security_best_practices");
  }

  Performance_best_practices(req, res) {
    res.render("./advances_topics/Performance_best_practice");
  }

  Health_checks_and_graceful_shutdown(req, res) {
    res.render("./advances_topics/Health_checks_and_graceful_shutdown");
  }
}

module.exports = new Advanced_topics_Controller();
