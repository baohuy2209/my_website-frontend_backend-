const mongoose = require("mongoose");
const Schema = mongoose.Schema;
const mongooseDelete = require("mongoose-delete");
var slug = require("mongoose-slug-generator");
const User = new Schema(
  {
    user: { type: String, required: true },
    pass: { type: String, required: true },
    email: { type: String, required: true },
  },
  {
    timestamp: true,
  }
);
mongoose.plugin(slug);
mongoose.plugin(mongooseDelete, {
  deleteAt: true,
  overrideMethods: "all",
});
module.exports = mongoose.model("User", User);
