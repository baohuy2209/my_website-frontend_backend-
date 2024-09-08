const express = require("express");
const dotenv = require("dotenv");
dotenv.config();
const app = express();
const PORT = process.env.PORT || 3006;
const routes = require("./routes/index.routes");
const cors = require("cors");
const errorHandler = require("./middleware/errorHandler");
const corsOptions = {
  origin: "http://localhost:3000",
  credentials: true,
};
const db = require("./config/db/index");
db.connectDB();
app.use(cors(corsOptions));
app.use(errorHandler);
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
routes(app);
app.listen(PORT, () => {
  console.log(`Listening on http://localhost:${PORT}`);
});
