const express = require("express");
const router = express.Router();
const resourseController = require("../app/controllers/Resource_Controller.js");

// render the Community page
router.get("/Community", resourseController.Community);
// render the Glossary page
router.get("/Glossary", resourseController.Glossary);
// render Template Engines page
router.get("/Template_Engines", resourseController.Template_Engines);
// render Middleware page
router.get("/Middleware", resourseController.Middleware);
// render Utility modules
router.get("/Utility_modules", resourseController.Utility_modules);
// render Frameworks page
router.get("/Frameworks", resourseController.Frameworks);
// render Companies using Express page
router.get(
  "/Companies_using_Express",
  resourseController.Companies_using_Express
);
// render Open source projects page
router.get("/Opensourceprojects", resourseController.Open_source_projects);
// render Additional learning page
router.get("/Additional_learning", resourseController.Additional_learning);
// router Contributing to express page
router.get(
  "/Contributing_to_express",
  resourseController.Contributing_to_express
);
// render Release Change Log
router.get("/ReleaseChangeLog", resourseController.Release_Change_Log);

module.exports = router;
