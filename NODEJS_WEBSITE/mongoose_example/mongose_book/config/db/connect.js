const mongoose = require("mongoose");
const Role = require("../../app/models/role.model");
async function connectDB() {
  try {
    mongoose.connect(process.env.CONNECTION_STRING);
    console.log("Connected db");
    initial();
  } catch (err) {
    console.log(err);
    console.log("Can't connect to database");
  }
}
function initial() {
  Role.estimatedDocumentCount()
    .then((count) => {
      if (count === 0) {
        const role_user = new Role({ name: "user" });
        role_user
          .save()
          .then(() => {
            console.log("added 'user' to roles collection");
          })
          .catch((err) => {
            console.log(err);
          });
        const role_moderator = new Role({ name: "moderator" });
        role_moderator
          .save()
          .then(() => {
            console.log("added 'moderator' to roles collection");
          })
          .catch((err) => {
            console.log(err);
          });
        const role_admin = new Role({ name: "admin" });
        role_admin
          .save()
          .then(() => {
            console.log("added 'admin' to roles collection");
          })
          .catch((err) => {
            console.log(err);
          });
      }
    })
    .catch((err) => {
      console.log(err);
    });
}
module.exports = { connectDB };
