const express = require("express");
const cors = require("cors");
const app = express();
const dotenv = require("dotenv");
dotenv.config();
const PORT = process.env.PORT || 8080;

app.use(
  cors({
    origin: "http://localhost:8081",
  })
);
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
const db = require("./app/models");
db.mongoose
  .connect(db.url, {
    useNewUrlParser: true,
    useUnifiedTopology: true,
  })
  .then(() => {
    console.log("Connected to the database");
  })
  .catch((err) => {
    console.log("Could not connect to the database", err);
    process.exit();
  });

require("./app/routes/tutorial.routes")(app);
app.listen(PORT, () => {
  console.log(`Listening on http://localhost:8080`);
});
