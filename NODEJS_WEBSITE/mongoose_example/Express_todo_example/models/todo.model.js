const mongoose = require("mongoose");
const Schema = mongoose.Schema;
const mongooseDelete = require("mongoose-delete");
var slug = require("mongoose-slug-generator");
const TodoSchema = new Schema(
  {
    user_id: String,
    content: String,
    updated_at: Date,
    slug: { type: String, slug: "user_id", unique: true },
  },
  {
    timestamps: true,
  }
);
mongoose.plugin(slug);
TodoSchema.plugin(mongooseDelete, {
  deleted: false,
  deleteAt: true,
  overrideMethods: "all",
});
module.exports = mongoose.model("Todo", TodoSchema);
