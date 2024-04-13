const mongoose = require("mongoose");
mongoose.Promise = global.Promise;
const db = {};
db.mongoose = mongoose;
db.category = require("./Category.js");
db.comment = require("./Comment.js");
db.image = require("./Image.js");
db.tutorial = require("./Tutorial.js");

module.exports = db;
