const mongoose = require("mongoose");
// initial new mongo_url
let MONGO_URL = process.env.MONGO_URL || "mongodb://127.0.0.1:27017/admin";

//function connect()
async function connect() {
  try {
    // execute the connection
    await mongoose.connect(MONGO_URL, {
      useUnifiedTopology: true,
      useNewUrlParser: true,
    });
    // if connection is successful, print to confirm
    console.log("Connect successfully");
  } catch (err) {
    // if connection is unsuccessful, print to confirm
    console.log("Connect failure");
  }
}

// export the function connect
module.exports = { connect };
