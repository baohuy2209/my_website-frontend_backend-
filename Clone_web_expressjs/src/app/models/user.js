const mongoose = require("mongoose");
const Schema = mongoose.Schema;
const mongooseDelete = require("mongoose-delete");
var slug = require("mongoose-slug-generator");
const User = new Schema(
  {
    Name: { type: String, maxLength: 255 },
    Password: { type: String, maxLength: 255 },
  },
  {
    timestamp: true,
  }
);
mongoose.plugin(slug);
mongoose.plugin(mongooseDelete, {
  deletedAt: true,
  overrideMethods: "all",
});
module.exports = mongoose.model("User", User);
