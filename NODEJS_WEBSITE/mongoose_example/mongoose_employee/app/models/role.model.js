const mongoose = require("mongoose");
var Schema = mongoose.Schema;
const Role = new Schema({
  name: String,
});
module.exports = mongoose.model("Role", Role);
