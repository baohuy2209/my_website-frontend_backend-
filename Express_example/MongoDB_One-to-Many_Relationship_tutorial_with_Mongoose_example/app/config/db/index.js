const db = require("../../../models");
const dbConfig = require("../db.config");

module.exports = function connect() {
  db.mongoose
    .connect(`mongodb://${dbConfig.HOST}:${dbConfig.PORT}/${dbConfig.DB}`, {
      useNewUrlParser: true,
      useUnifiedTopology: true,
    })
    .then(() => {
      console.log("Successfully connect to MongoDB");
    })
    .catch((err) => {
      console.log("Connecton error :", err);
      process.exit(1);
    });
};
