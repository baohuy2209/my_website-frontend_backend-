const express = require("express");
const router = express.Router();

const api_reference = require("../app/controllers/API_reference_Controller.js");

router.get("/Version5x_beta", api_reference.render_5x_beta);
router.get("/Version_4x", api_reference.render_4x);
router.get("/Version_3x", api_reference.render_3x_deprecated);

module.exports = router;
