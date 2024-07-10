const express = require("express");
const router = express.Router();
const AppController = require("../app/controller/app.controller");
router.get("/stock", AppController.getOneElement);
router.post("/watchlist", AppController.postOneElement);
module.exports = router;
