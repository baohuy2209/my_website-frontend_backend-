const mongoose = require("mongoose");
const Role = require("../../app/models/role.model");
const Typebook = require("../../app/models/type.model");
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
  Typebook.estimatedDocumentCount()
    .then((count) => {
      if (count == 0) {
        const programming = new Typebook({ typebook: "programming_book" });
        programming
          .save()
          .then(() => {
            console.log("added type 'programing_book' to typebook collection");
          })
          .catch((err) => {
            console.log(err);
          });
        const edu_book = new Typebook({ typebook: "educational_book" });
        edu_book
          .save()
          .then(() => {
            console.log("added type 'educational_book' to typebook collection");
          })
          .catch((err) => {
            console.log(err);
          });
        const another_type = new Typebook({ typebook: "another_type" });
        another_type
          .save()
          .then(() => {
            console.log("added type 'another_type' to typebook collection");
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
