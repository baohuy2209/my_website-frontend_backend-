const mongoose = require("mongoose");
var Schema = mongoose.Schema;
const mongooseDelete = require("mongoose-delete");
var slug = require("mongoose-slug-generator");
const Employee = new Schema(
  {
    name: { type: String, required: true },
    email: { type: String, required: true, unique: true },
    age: { type: Number, required: true },
    position: { type: String, required: true },
    salary: { type: Number, required: true },
    phonenumber: { type: String, required: true },
    slug: { type: String, slug: "name", unique: true },
    image: { type: String },
    dob: { type: Date, required: true },
    code_resident: { type: String, required: true },
  },
  {
    timestamps: true,
  }
);
mongoose.plugin(slug);
Employee.plugin(mongooseDelete, {
  deletedAt: true,
  overrideMethods: "all",
});
module.exports = mongoose.model("Employees", Employee);
