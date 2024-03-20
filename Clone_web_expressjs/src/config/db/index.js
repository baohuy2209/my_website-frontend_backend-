const mongoose = require("mongoose");

let MONGO_URL = process.env.MONGO_URL || "mongodb://127.0.0.1:27017/admin";

async function connect() {
  try {
    await mongoose.connect(MONGO_URL, {
      useUnifiedTopology: true,
      useNewUrlParser: true,
    });
    console.log("Connect successfully");
  } catch (err) {
    console.log("Connect failure");
  }
}
module.exports = { connect };
