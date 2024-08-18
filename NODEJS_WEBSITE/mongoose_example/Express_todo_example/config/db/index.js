const mongoose = require("mongoose");
function connect() {
  mongoose
    .connect("mongodb://localhost:27017/express-todo", {
      useNewUrlParser: true,
      useUnifiedTopology: true,
    })
    .then(() => {
      console.log("MongoDB connected");
    })
    .catch((err) => {
      console.error("MongoDB connection error: ", err);
    });
}
module.exports = { connect };
