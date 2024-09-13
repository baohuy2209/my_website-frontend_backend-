const mongoose = require("mongoose");
const Schema = mongoose.Schema;
const Tutorial = new Schema(
  {
    title: String,
    description: String,
    published: Boolean,
  },
  {
    timestamps: true,
  }
);
module.exports = mongoose.model("Tutorial", Tutorial);
