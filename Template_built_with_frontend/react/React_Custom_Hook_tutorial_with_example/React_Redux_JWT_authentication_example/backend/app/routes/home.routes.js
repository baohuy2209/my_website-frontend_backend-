const express = require("express");
const router = express.Router();
router.get("/", (req, res) => {
  res.send({ message: "Welcome to my application!" });
});
module.exports = router;
