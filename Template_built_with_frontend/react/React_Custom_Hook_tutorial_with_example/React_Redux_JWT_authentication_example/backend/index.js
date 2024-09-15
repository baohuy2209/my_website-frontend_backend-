const express = require("express");
const app = express();
const dotenv = require("dotenv");
dotenv.config();
const PORT = process.env.PORT || 8080;
const cors = require("cors");
const cookieSession = require("cookie-session");
const corsOptions = {
  origin: "http://localhost:5173",
  credentials: true,
};
const db = require("./config/db/index");
const routes = require("./routes/index.routes");
app.use(
  cookieSession({
    name: "baohuy-session",
    keys: [process.env.COOKIE_SECRET],
    httpOnly: true,
  })
);
app.use(cors(corsOptions));
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
db.connectDB();
routes(app);
app.listen(PORT, () => {
  console.log(`Server on http://localhost:${PORT}`);
});
