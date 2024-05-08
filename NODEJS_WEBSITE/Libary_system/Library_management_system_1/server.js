const express = require("express");
const app = express();
const port = 3000;
const bodyParser = require("body-parser");
const db = require("./config/db/index");
const route = require("./routes/index.routes");
db.connect();
const books = [
  {
    bookName: "Rudest Book Ever",
    bookAuthor: "Shwetabh Gangwar",
    bookPages: 200,
    bookPrice: 240,
    bookState: "Available",
  },
  {
    bookName: "Do Epic Shit",
    bookAuthor: "Ankur Wariko",
    bookPages: 200,
    bookPrice: 240,
    bookState: "Available",
  },
];
app.use(bodyParser.json());
app.use(
  bodyParser.urlencoded({
    extended: true,
  })
);
app.set("view engine", "ejs");
route(app);
app.listen(port, () => {
  console.log(`Listening on http://localhost:${port}`);
});
