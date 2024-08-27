const mongoose = require("mongoose");
const Schema = mongoose.Schema;
const TypeBook = new Schema({
  typebook: String,
});
module.exports = mongoose.model("Typebook", TypeBook);
