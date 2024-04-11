const express = require("express");
const app = express();
const morgan = require("morgan");
const cors = require("cors");
const routes = require("./app/routes/tutorial.routes.js");
const port = process.env.POST || 3000;
var corOptions = {
  origin: "http://localhost:8081",
};
app.use(cors(corsOptions));
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(morgan("combined"));

app.get("/", (req, res) => {
  res.json({ message: "Welcome to bezkoder application" });
});

app.listen(port, () => {
  console.log(`Listening on http://localhost:${port}`);
});
