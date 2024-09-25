const mongoose = require("mongoose");
const Role = require("../../models/role.model");
async function connectDB() {
  try {
    await mongoose.connect(process.env.CONNECTION_STRING);
    initial();
    console.log("Connected to database");
  } catch (error) {
    console("Failed to connect with the database");
    console.log(error);
  }
}
function initial() {
  Role.estimatedDocumentCount()
    .then((count) => {
      if (count === 0) {
        new Role({ name: "ROLE_USER" })
          .save()
          .then(() => {
            console.log("Added `ROLE_USER` to the database");
          })
          .catch((error) => {
            console.log(error);
          });
        new Role({ name: "ROLE_ADMIN" })
          .save()
          .then(() => {
            console.log("Added `ROLE_ADMIN` to the database");
          })
          .catch((error) => {
            console.log(error);
          });
        new Role({ name: "ROLE_MODERATOR" })
          .save()
          .then(() => {
            console.log("Added `ROLE_MODERATOR` to the database");
          })
          .catch((error) => {
            console.log(error);
          });
      }
    })
    .catch((error) => {
      console.log(error);
    });
}
module.exports = { connectDB };
