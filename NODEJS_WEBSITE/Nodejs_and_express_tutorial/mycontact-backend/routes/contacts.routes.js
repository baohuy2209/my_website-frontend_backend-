const express = require("express");
const router = express.Router();
const controller = require("../controllers/Contact.controller");
const validateToken = require("../middleware/validateTokenHandler");
router.use(validateToken);
router.route("/").get(controller.getContacts).post(controller.createContact);
router
  .route("/:id")
  .get(controller.getContact)
  .put(controller.updateContact)
  .delete(controller.deleteContact);
module.exports = router;
