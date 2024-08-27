const mongoose = require("mongoose");
const Schema = mongoose.Schema;
const mongooseDelete = require("mongoose-delete");
const slug = require("mongoose-slug-generator");
const Book = new Schema(
  {
    name: { type: String },
    number_of_pages: { type: Number },
    author: { type: String, maxLength: 100 },
    price: { type: Number, min: 0 },
    rating: { type: Number, min: 0, max: 5 },
    number_book_selled: { type: Number, min: 0 },
    number_book_selling: { type: Number, min: 0 },
    description: { type: String },
    image: {
      type: String,
      required: true,
    },
    slug: { type: String, slug: "name", unique: true },
    number_consider: { type: Number, min: 0 },
    type: {
      type: mongoose.Schema.Types.ObjectId,
      ref: "Typebook",
    },
  },
  {
    timestamps: true,
  }
);
mongoose.plugin(slug);
Book.plugin(mongooseDelete, {
  deleted: false,
  deleteAt: true,
  overrideMethods: "all",
});
module.exports = mongoose.model("Book", Book);
