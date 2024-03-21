const express = require("express");
const router = express.Router();

const advtopicController = require("../app/controllers/Advanced_topics_Controllers.js");

router.get("/TemplateEngines", advtopicController.Template_engines);
router.get("/ProcessManages", advtopicController.Process_managers);
router.get("/SecurityUpdates", advtopicController.Security_updates);
router.get(
  "/SecurityBestPractices",
  advtopicController.Security_best_practices
);
router.get(
  "/PerfomanceBestPractices",
  advtopicController.Performance_best_practices
);
router.get(
  "/HealthCheckAndGracefulShutdown",
  advtopicController.Health_checks_and_graceful_shutdown
);

module.exports = router;
