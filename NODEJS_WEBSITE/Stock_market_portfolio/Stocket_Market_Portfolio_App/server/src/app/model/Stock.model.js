const mongoose = require("mongoose");
const Schema = mongoose.Schema;
const Stock = new Schema({
  company: String,
  description: String,
  initial_price: Number,
  price_2002: Number,
  price_2007: Number,
  symbol: String,
});

module.exports = mongoose.model("Stock", Stock);
