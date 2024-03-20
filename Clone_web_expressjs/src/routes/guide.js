const express = require("express");
const router = express.Router();
const guideController = require("../app/controllers/Guide_Controller.js");

router.get("/Routing", guideController.render_Routing);
router.get("/Writing_middleware", guideController.render_Writing_middleware);
router.get("/Using_middleware", guideController.render_Using_middleware);
router.get(
  "/Override_the_Express_API",
  guideController.render_Overriding_the_Express_API
);
router.get(
  "/Using_template_engines",
  guideController.render_Using_template_engines
);
router.get("/Error_handing", guideController.render_Error_handling);
router.get("/Debugging", guideController.render_Debugging);
router.get(
  "/Express_behind_proxies",
  guideController.render_Express_behind_proxies
);
router.get("/Moving_to_Express_4", guideController.render_Moving_to_Express_4);
router.get("/Moving_to_Express_5", guideController.render_Moving_to_Express_5);
router.get("/DatabaseIntegration", guideController.render_Database_Integration);

module.exports = router;
