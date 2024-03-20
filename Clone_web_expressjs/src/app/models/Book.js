const mongoose = require("mongoose");
const Schema = mongoose.Schema;
const mongooseDelete = require("mongoose-delete");
var slug = require("mongoose-slug-generator");
const Book = new Schema(
  {
    Name: { type: String },
    Number_of_pages: { type: Number },
    Author: { type: String, maxLength: 100 },
    Price: { type: Number, min: 0 },
    Rating: { type: Number, min: 0, max: 5 },
    Number_book_selled: { type: Number, min: 0 },
    Number_book_selling: { type: Number, min: 0 },
    Description: { type: String, maxLength: 1000000 },
    Image: { type: String, required: true },
    slug: { type: String, slug: "Name", unique: true },
    Number_consider: { type: Number, min: 0 },
  },
  {
    timestamps: true,
  }
);
Book.query,
  (sortable = function (req) {
    if (req.query.hashOwnProperty("_sort")) {
      const isValidType = ["asc", "desc"].includes(req.query.type);
      return this.sort({
        [req.query.column]: isValidType ? req.query.type : "desc",
      });
    }
    return this;
  });
mongoose.plugin(slug);
Book.plugin(mongooseDelete, {
  deleted: False,
  deleteAt: true,
  overrideMethods: "all",
});
module.exports = mongoose.model("Book", Book);
