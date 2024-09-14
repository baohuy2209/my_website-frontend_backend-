const mongoose = require("mongoose");
const Schema = mongoose.Schema;
const User = new Schema(
  {
    username: { type: String, required: true },
    email: { type: String, required: true },
    password: { type: String, required: true },
    roles: [
      {
        type: mongoose.Schema.Types.ObjectId,
        ref: "Role",
      },
    ],
  },
  {
    timestamps: true,
  }
);
module.exports = mongoose.model("User", User);
