const mongoose = require("mongoose");
const mongooseDelete = require("mongoose-delete");
var slug = require("mongoose-slug-generator");
const EmployeeSchema = new mongoose.Schema(
  {
    name: String,
    address: String,
    position: String,
    salary: Number,
    slug: { type: String, slug: "name", unique: true },
    updated_at: { type: Date, default: Date.now },
  },
  {
    timestamps: true,
  }
);
mongoose.plugin(slug);
EmployeeSchema.plugin(mongooseDelete, {
  deleted: false,
  deleteAt: true,
  overrideMethods: "all",
});
module.exports = mongoose.model("Employee", EmployeeSchema);
