const express = require("express");
const app = express();
const dotenv = require("dotenv");
const cors = require("cors");
const corsOptions = {
  origin: " http://localhost:5173",
  crendentials: true,
};
const db = require("./config/db/index");
dotenv.config();
db.connectDB();
const PORT = process.env.PORT || 8080;
app.use(cors(corsOptions));
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.listen(PORT, () => {
  console.log(`Listening on http://localhost:${PORT}`);
});
