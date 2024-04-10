class Guide_Controller {
  render_Routing(req, res) {
    res.render("./guide/Routing");
  }

  render_Writing_middleware(req, res) {
    res.render("./guide/Writing_middleware");
  }

  render_Using_middleware(req, res) {
    res.render("./guide/Using_middleware");
  }

  render_Overriding_the_Express_API(req, res) {
    res.render("./guide/Overriding_the_Express_API");
  }

  render_Using_template_engines(req, res) {
    res.render("./guide/Using_template_engines");
  }

  render_Error_handling(req, res) {
    res.render("./guide/Error_handing");
  }

  render_Debugging(req, res) {
    res.render("./guide/Debugging");
  }

  render_Express_behind_proxies(req, res) {
    res.render("./guide/Express_behind_proxies");
  }

  render_Moving_to_Express_4(req, res) {
    res.render("./guide/Moving_to_Express_4");
  }

  render_Moving_to_Express_5(req, res) {
    res.render("./guide/Moving_to_Express_5");
  }

  render_Database_Integration(req, res) {
    res.render("./guide/Database_integration");
  }
}

module.exports = new Guide_Controller();
