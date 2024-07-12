const mongoose = require("mongoose");
const Schema = mongoose.Schema;

const ContactSchema = new Schema(
  {
    user_id: {
      type: mongoose.Schema.Types.ObjectId,
      required: true,
      ref: "User",
    },
    name: {
      type: String,
      required: [true, "Please add the contact name"],
    },
    email: {
      type: String,
      required: [true, "Please add the contact email"],
    },
    phone: {
      type: String,
      required: [true, "Please add the contact phone"],
    },
  },
  {
    timestamps: true,
  }
);
module.exports = mongoose.model("Contact", ContactSchema);
