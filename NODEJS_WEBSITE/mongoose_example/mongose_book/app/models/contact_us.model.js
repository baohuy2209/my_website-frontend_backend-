const mongoose = require("mongoose");
var Schema = mongoose.Schema;
const ContactSchema = new Schema(
  {
    fullname: { type: String, required: true },
    email: { type: String, required: true },
    phonenumber: { type: String, required: true },
    your_request: { type: String, required: true },
  },
  {
    timestamp: true,
  }
);
module.exports = mongoose.model("Contact_us", ContactSchema);
