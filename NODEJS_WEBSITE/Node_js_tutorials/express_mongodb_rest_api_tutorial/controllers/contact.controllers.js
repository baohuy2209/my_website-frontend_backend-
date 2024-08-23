const asyncHandler = require("express-async-handler");
const Contact = require("../models/contact.model");
class ContactController {
  /**
   * @desc Get all contacts
   * @route GET /api/contacts
   * @access private
   */
  getContacts = asyncHandler(async (req, res) => {
    const contacts = await Contact.find({ user_id: req.user_id });
    res.status(200).json(contacts);
  });
  /**
   * @desc Create new contact
   * @route POST /api/contacts
   * @access private
   */
  createContact = asyncHandler(async (req, res) => {
    console.log("The request body is: ", req.body);
    const { name, email, phone } = req.body;
    if (!name || !email || !phone) {
      res.status(400);
      throw new Error("All fields are mandatory !");
    }
    const contact = await Contact.create({
      name,
      email,
      phone,
      user_id: req.user_id,
    });
    res.status(201).json(contact);
  });
  /**
   * @desc Get a contact
   * @route GET /api/contacts/:id
   * @access private
   */
  getContact = asyncHandler(async (req, res) => {
    const contact = await Contact.findById(req.params.id);
    if (!contact) {
      res.status(404);
      throw new Error("Contact not found");
    }
    if (contact.user_id !== req.user_id) {
      res.status(403);
      throw new Error("User unauthorized for this operation");
    }
    res.status(200).json(contact);
  });
  /**
   * @desc Update contact
   * @route PUT /api/contacts/:id
   * @access private
   */
  updateContact = asyncHandler(async (req, res) => {
    // find contact by id which is in url
    const contact = await Contact.findById(req.params.id);
    // check if have the contact which you need
    if (!contact) {
      res.status(404);
      throw new Error("Contact not found");
    }
    // ! don't allow to update contacts
    if (contact.user_id.toString() !== req.user_id) {
      res.status(403);
      throw new Error(
        "User don't have permission to update other user contacts"
      );
    }
    const updatedContact = await Contact.findByIdAndUpdate(
      req.params.id,
      req.body,
      { new: true }
    );
    res.status(200).json(updatedContact);
  });
  /**
   * @desc Delete contact
   * @route DELETE /api/contacts/:id
   * @access private
   */
  deleteContact = asyncHandler(async (req, res) => {
    const contact = await Contact.findById(req.params.id);
    if (!contact) {
      res.status(404);
      throw new Error("Contact not found");
    }
    if (contact.user_id.toString !== req.user_id) {
      res.status(403);
      throw new Error(
        "User don't have permission to delete other user contacts"
      );
    }
    await Contact.findByIdAndDelete(req.params.id);
    res.status(200).json(contact);
  });
}
module.exports = new ContactController();
