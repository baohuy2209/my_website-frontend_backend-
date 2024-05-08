const express = require("express");
var router = express.Router();
const bookcontroller = require("../controllers/BookController");
router.get("/", bookcontroller.index);
router.post("/", bookcontroller.add_newbook);
router.post("/issue", bookcontroller.issue_book);
router.post("/return", bookcontroller.return_book);
router.post("/delete", bookcontroller.delete_book);
module.exports = router;
