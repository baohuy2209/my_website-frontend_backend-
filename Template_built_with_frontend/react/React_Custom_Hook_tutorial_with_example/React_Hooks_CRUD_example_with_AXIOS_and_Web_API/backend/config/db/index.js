const mongoose = require("mongoose");
async function connectDB() {
  try {
    mongoose.connect(process.env.CONNECTION_STRING);
    console.log("Connected the database");
  } catch (error) {
    console.log("Failed to connect with database");
    console.log(error);
  }
}
module.exports = { connectDB };
