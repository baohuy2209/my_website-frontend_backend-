const Contact = require("../models/contact.model");
class ContactController {
  // GET /api/contacts/
  getAllContact = (req, res) => {
    Contact.find({})
      .then((contacts) => {
        res.status(201).json(contacts);
      })
      .catch((err) => {
        res.status(400);
        throw new Error(JSON.stringify(err));
      });
  };
  // GET /api/contacts/:id
  getOne = (req, res) => {
    Contact.findById(req.params.id)
      .then((contact) => {
        res.status(201).json(contact);
      })
      .catch((err) => {
        res.status(400);
        throw new Error(JSON.stringify(err));
      });
  };
  // POST /api/contacts/
  create = (req, res) => {
    const { name, email } = req.body;
    if (!name || !email) {
      res.status(400);
      throw new Error("All fields is mandatory");
    }
    const newContact = new Contact({ name, email });
    newContact
      .save()
      .then(() => {
        console.log("Added new contact");
      })
      .catch((err) => {
        res.status(500);
        throw new Error(JSON.stringify(err));
      });
  };
  // PUT /api/contacts/:id
  update = (req, res) => {
    Contact.findByIdAndUpdate(req.params.id)
      .then(() => {
        console.log("Updated the requested Contact");
      })
      .catch((err) => {
        res.status(400);
        throw new Error(JSON.stringify(err));
      });
  };
  // DELETE /api/contacts/:id
  delete = (req, res) => {
    Contact.findByIdAndDelete(req.params.id)
      .then(() => {
        console.log("Deleted the requested Contact");
      })
      .catch((err) => {
        res.status(404);
        throw new Error(JSON.stringify(err));
      });
  };
}
module.exports = new ContactController();
