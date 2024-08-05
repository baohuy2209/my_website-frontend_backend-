const express = require("express");
const dotenv = require("dotenv");
const cors = require("cors");
const cookieSession = require("cookie-session");
const mongoose = require("mongoose");
const db = require("./app/config/db/index");
const route = require("./app/routes/index.routes");
const app = express();
dotenv.config();
db.connect();
mongoose.set("strictQuery", false);
const PORT = process.env.PORT || 5000;
var corsOptions = {
  origin: "http://localhost:3000",
};
app.use(cors(corsOptions));
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(
  cookieSession({
    name: "baohuy",
    keys: ["COOKIE_SECRET"],
    httpOnly: true,
  })
);
app.use(require("./app/middleware/errorHandler"));
app.get("/", (req, res) => {
  res.json({ message: "Hello world!" });
});
app.listen(PORT, () => {
  console.log(`Listening on http://localhost:${PORT}`);
});
