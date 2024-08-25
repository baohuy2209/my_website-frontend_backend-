const mongoose = require("mongoose");
const Schema = mongoose.Schema;
const UserSchema = new Schema({
  username: {
    type: String,
    required: true,
    unique: true,
  },
  email: {
    type: String,
    required: true,
  },
  password: {
    type: String,
    required: true,
  },
  roles: [
    {
      type: mongoose.Schema.Types.ObjectId,
      ref: "Role",
    },
  ],
  avatar: {
    type: String,
  },
  dob: { type: Date, required: true },
  age: { type: Number },
  phonenumber: { type: String },
  gender: { type: String },
  address: { type: String },
});
module.exports = mongoose.model("User", UserSchema);
