const express = require("express");
var router = express.Router();
const controller = require("../app/controllers/BookController");
const authJWT = require("../app/middleware/authJWT");
// [GET] /api/books/create with admin role
router.get("/create", [authJWT.verifyToken], controller.create);
// [GET] /api/books/create with moderator role
// router.get(
//   "/create",
//   [authJWT.verifyToken, authJWT.isModerator],
//   controller.create
// );
// [POST] /api/books/create
router.post("/create", controller.store);
// [POST] /api/books/:id
router.get("/:id", controller.showDetail);
// [GET] /api/booke/update/:id/edit
router.get(
  "/update/:id/edit",
  [authJWT.verifyToken, authJWT.isAdmin],
  controller.showUpdate
);
router.get(
  "/update/:id/edit",
  [authJWT.verifyToken, authJWT.isAdmin],
  controller.showUpdate
);
// [PUT] /api/books/update/:id
router.put("/update/:id", controller.update);
// [DELETE] /api/books/destroy/:id soft delete
router.delete("/destroy/:id", controller.destroy);
// [PATCH] /api/books/restore/:id
router.patch("/restore/:id", controller.restore);
// [DELETE] /api/book/forceDelete/:id
router.delete("/forceDelete/:id", controller.forceDelete);
module.exports = router;
