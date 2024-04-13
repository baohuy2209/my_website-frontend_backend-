const express = require("express");
const cors = require("cors");
const cookieSession = require("cookie-session");
const app = express();
const mongoose = require("mongoose");
const route = require("./app/routes/index.routes");
const database_connect = require("./app/config/db/index");
mongoose.set("strictQuery", false);
var corsOptions = {
  origin: "http://localhost:8081",
};

app.use(cors(corsOptions));
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(
  cookieSession({
    name: "bezkoder-session",
    keys: ["COOKIE_SECRET"],
    httpOnly: true,
  })
);
// connect database
database_connect.connect();
// router
route(app);
const PORT = process.env.PORT || 8080;
app.listen(PORT, () => {
  console.log(`Server is running on port http://localhost:${PORT}`);
});
