const mongoose = require("mongoose");
const MONGODBURL =
  process.env.CONNECTION_STRING || "mongodb://localhost:27017/local";
const connectDb = async () => {
  try {
    const conect = await mongoose.connect(MONGODBURL, {
      useNewUrlParser: true,
      useUnifiedTopology: true,
    });
    console.log(
      "Database connected: ",
      conect.connection.host,
      conect.connection.name
    );
  } catch (err) {
    console.log(err);
    process.exit(1);
  }
};
module.exports = { connectDb };
