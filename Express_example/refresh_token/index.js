const express = require("express");
const cors = require("cors");
const cookieSession = require("cookie-session");
const app = express();
const mongoose = require("mongoose");
mongoose.set("strictQuery", false);
var corsOptions = {
  origin: "http://localhost:8001",
};
app.use(cors(corsOptions));
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(
  cookieSession({
    name: "bh-session",
    keys: ["COOKIE-SECRET"],
    httpOnly: true,
  })
);
const port = process.env.port || 8080;
app.listen(port, () => {
  console.log(`Server is running on port http://localhost:${port}`);
});
