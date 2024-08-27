const express = require("express");
const router = express.Router();
const controller = require("../app/controllers/ManageBookController");
const authJwt = require("../app/middleware/authJWT");
// [GET] /api/manage/stored/book
router.get("/stored/book", [authJwt.verifyToken], controller.stored);
// [GET] /api/manage/stored/book
// router.get(
//   "/stored/book",
//   [authJwt.verifyToken, authJwt.isModerator],
//   controller.stored
// );
// [GET] /api/manage/trash/book
router.get("/trash/book", [authJwt.verifyToken], controller.trash);
// [GET] /api/manage/trash/book
// router.get(
//   "/trash/book",
//   [authJwt.verifyToken, authJwt.isModerator],
//   controller.trash
// );
module.exports = router;
