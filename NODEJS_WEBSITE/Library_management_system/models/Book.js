const mongoose = require("mongoose");
const Schema = mongoose.Schema;
const Book = new Schema(
  {
    bookName: { type: String },
    bookAuthor: { type: String },
    bookPages: { type: Number },
    bookState: { type: String },
  },
  {
    timestamps: true,
  }
);
module.exports = mongoose.model("Book", Book);
