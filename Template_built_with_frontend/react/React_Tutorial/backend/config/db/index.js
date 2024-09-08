const mongoose = require("mongoose");
async function connectDB() {
  try {
    await mongoose.connect(process.env.CONNECTION_STRING);
    console.log("Connected DB");
  } catch (error) {
    console.log(error);
    console.log("Can't connect DB");
  }
}
module.exports = { connectDB };
