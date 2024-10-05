const dbConfig = require("../config/db.config.js");
const mongoose = require("mongoose");
mongoose.Promise = global.Promise;
const db = {};
db.mongoose = mongoose;
db.tutorials = require("./tutorial.model.js")(mongoose);
db.url = dbConfig.url;
module.exports = db;
