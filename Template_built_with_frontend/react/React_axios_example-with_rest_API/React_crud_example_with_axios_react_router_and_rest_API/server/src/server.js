const express = require("express");
const app = express();
const dotenv = require("dotenv");
const cors = require("cors");
dotenv.config();
var corsOptions = {
  origin: "http://localhost:3000",
};
const PORT = process.env.PORT || 8080;
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(cors(corsOptions));
app.use(require("./app/middleware/errorHandler"));
app.get("/", (req, res) => {
  res.json({ message: "Hello, world!" });
});
app.listen(PORT, () => {
  console.log(`Listenin on http://localhost:${PORT}`);
});
