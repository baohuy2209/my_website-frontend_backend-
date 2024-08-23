const express = require("express");
const dotenv = require("dotenv");
dotenv.config();
const app = express();
const PORT = process.env.PORT || 5000;
const db = require("./config/db/connect");
const mongoose = require("mongoose");
mongoose.set("strictQuery", false);
db.connectDb();
app.use(express.json());
app.use(express.urlencoded({ extname: true }));
app.use("/api/contacts", require("./routes/contactRoutes"));
app.use("/api/users", require("./routes/userRoutes"));
app.listen(PORT, () => {
  console.log(`Listening on http://localhost:${PORT}`);
});
