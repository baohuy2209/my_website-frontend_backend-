const mongoose = require("mongoose");
const MONGODB_URL =
  process.env.MONGODB_URL || "mongodb://localhost:27017/contactDatabase";
const connectDB = async () => {
  try {
    const connect = await mongoose.connect(MONGODB_URL, {
      useUnifiedTopology: true,
      useNewUrlParser: true,
    });
    console.log(
      "Database connected: ",
      connect.connection.host,
      connect.connection.name
    );
  } catch (err) {
    console.error(err);
    process.exit(1);
  }
};
module.exports = { connectDB };
