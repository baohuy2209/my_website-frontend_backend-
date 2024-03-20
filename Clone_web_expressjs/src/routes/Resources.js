const express = require("express");
const router = express.Router();
const resourseController = require("../app/controllers/Resource_Controller.js");

router.get("/Community", resourseController.Community);
router.get("/Glossary", resourseController.Glossary);
router.get("/Template_Engines", resourseController.Template_Engines);
router.get("/Middleware", resourseController.Middleware);
router.get("/Utility_modules", resourseController.Utility_modules);
router.get("/Frameworks", resourseController.Frameworks);
router.get(
  "/Companies_using_Express",
  resourseController.Companies_using_Express
);
router.get("/Opensourceprojects", resourseController.Open_source_projects);
router.get("/Additional_learning", resourseController.Additional_learning);
router.get(
  "/Contributing_to_express",
  resourseController.Contributing_to_express
);
router.get("/ReleaseChangeLog", resourseController.Release_Change_Log);

module.exports = router;
