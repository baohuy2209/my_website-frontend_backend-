const mongoose = require("mongoose");
let MONGO_URL =
  process.env.MONGO_URL || "mongodb://127.0.0.1:27017/Stock_Website";
async function connectDB() {
  try {
    await mongoose.connect(MONGO_URL, {
      useNewUrlParser: true,
      useUnifiedTopology: true,
    });
    console.log("Connected to MongoDB");
  } catch (e) {
    console.log("There are some errors when connect to DB");
    console.log(e);
  }
}
module.exports = { connectDB };
