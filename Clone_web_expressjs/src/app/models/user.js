const mongoose = require("mongoose");
// execute the Schema
const Schema = mongoose.Schema;
// import mongoose-delete package
const mongooseDelete = require("mongoose-delete");
// import mongoose slug
var slug = require("mongoose-slug-generator");
const User = new Schema(
  {
    UserName: { type: String, maxLength: 255 }, // field name
    Password: { type: String, maxLength: 255 }, // field password
    Email: { type: String },
    Phone_number: { type: String },
    Birthday: { type: Date },
  },
  {
    timestamp: true, // create createdAtTime
  }
);
mongoose.plugin(slug);
mongoose.plugin(mongooseDelete, {
  deletedAt: true, // add property "deleteAt"
  overrideMethods: "all",
});
module.exports = mongoose.model("User", User);
