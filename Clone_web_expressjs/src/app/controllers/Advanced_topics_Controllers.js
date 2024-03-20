class Advanced_topics_Controller {
  Template_engines(req, res, next) {
    res.render("./Advances_topics/Template_engines");
  }

  Process_managers(req, res) {
    res.render("./Advances_topics/Process_managers");
  }

  Security_updates(req, res) {
    res.render("./Advances_topics/Security_updates");
  }

  Security_best_practices(req, res) {
    res.render("./Advances_topics/security_best_practices");
  }

  Performance_best_practices(req, res) {
    res.render("./Advances_topics/Performance_best_practice");
  }

  Health_checks_and_graceful_shutdown(req, res) {
    res.render("./Advances_topics/Health_checks_and_graceful_shutdown");
  }
}

module.exports = new Advanced_topics_Controller();
