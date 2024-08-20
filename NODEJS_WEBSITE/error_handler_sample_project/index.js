const express = require("express");
const app = express();
const dotenv = require("dotenv");
const errorHandler = require("./middleware/errorHandler");
dotenv.config();
const PORT = process.env.PORT || 3000;
app.use(errorHandler);
app.get("/", (req, res) => {
  res.send("Hello world");
});
app.listen(PORT, () => {
  console.log(`Listening on http://localhost:${PORT}`);
});
