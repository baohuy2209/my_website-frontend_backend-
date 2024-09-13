const express = require("express");
const app = express();
const dotenv = require("dotenv");
const cors = require("cors");
const routes = require("./routes/index.routes");
const corsOptions = {
  origin: " http://localhost:3000",
  crendentials: true,
};
const db = require("./config/db/index");
dotenv.config();
db.connectDB();
const PORT = process.env.PORT || 8080;
const mongoose = require("mongoose");
mongoose.set("strictQuery", false);
app.use(cors(corsOptions));
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
routes(app);
app.listen(PORT, () => {
  console.log(`Listening on http://localhost:${PORT}`);
});
