class API_reference_Controller {
  render_5x_beta(req, res) {
    res.render("./API_reference/API_5x");
  }

  render_4x(req, res) {
    res.render("./API_reference/API_4x");
  }

  render_3x_deprecated(req, res) {
    res.render("./API_reference/API_3x");
  }
}

module.exports = new API_reference_Controller();
