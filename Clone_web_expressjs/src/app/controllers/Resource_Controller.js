class Resource_Controller {
  Community(req, res) {
    res.render("./resources_express/Community");
  }

  Glossary(req, res) {
    res.render("./resources_express/Glossary");
  }

  Template_Engines(req, res) {
    res.render("./resources_express/temple_engine_resources");
  }

  Middleware(req, res) {
    res.render("./resources_express/Middleware");
  }

  Utility_modules(req, res) {
    res.render("./resources_express/Utility_modules");
  }

  Frameworks(req, res) {
    res.render("./resources_express/Frameworks");
  }

  Companies_using_Express(req, res) {
    res.render("./resources_express/companies_using_Express");
  }

  Open_source_projects(req, res) {
    res.render("./resources_express/Open_sources_projects");
  }

  Additional_learning(req, res) {
    res.render("./resources_express/Additional_learning");
  }

  Contributing_to_express(req, res) {
    res.render("./resources_express/Contributing_to_express");
  }

  Release_Change_Log(req, res) {
    res.render("./resources_express/Release_Change_Log");
  }
}

module.exports = new Resource_Controller();
