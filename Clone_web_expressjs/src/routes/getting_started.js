const express = require("express");

const router = express.Router();
const getting_started = require("../app/controllers/Getting_started_Controller.js");

router.get("/Installing", getting_started.render_installing);
router.get("/Hello_world", getting_started.render_hello_world);
router.get("/Express_generator", getting_started.render_Express_generator);
router.get("/Basic_routing", getting_started.render_Basic_routing);
router.get("/Static_files", getting_started.render_Static_files);
router.get("/More_example", getting_started.render_More_examples);
router.get("/FAQ", getting_started.render_FAQ);

module.exports = router;
