const mongoose = require("mongoose");
async function connectDB() {
  try {
    mongoose.connect("mongodb://localhost:27017/f8_education_dev", {
      useNewUrlParser: true,
      useUnifiedTopology: true,
    });
    console.log("Connected to MongoDB");
  } catch (error) {
    console.log("Connect failure !!!");
  }
}
module.exports = { connectDB };
