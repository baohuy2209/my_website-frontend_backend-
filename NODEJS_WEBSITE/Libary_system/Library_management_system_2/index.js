const express = require("express");
const app = express();
const port = 3000;
const bodyParser = require("body-parser");
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
app.get("/", (req, res) => {
  res.render("home", { data: books });
});
app.post("/", (req, res) => {
  const inputBookName = req.body.bookName;
  const inputBookAuthor = req.body.bookAuthor;
  const inputBookPages = req.body.bookPages;
  const inputBookPrice = req.body.bookPrice;

  books.push({
    bookName: inputBookName,
    bookAuthor: inputBookAuthor,
    bookPages: inputBookPages,
    bookPrice: inputBookPrice,
    bookState: "Available",
  });

  res.render("home", {
    data: books,
  });
});
app.post("/issue", (req, res) => {
  var requestedBookName = req.body.bookName;
  books.forEach((book) => {
    if (book.bookName == requestBookName) {
      book.bookState = "Issued";
    }
  });
  res.render("home", {
    data: books,
  });
});
app.post("/return", (req, res) => {
  var requestedBookName = req.body.bookName;
  books.forEach((book) => {
    if (book.bookName == requestedBookName) {
      book.bookState = "Available";
    }
  });
  res.render("home", {
    data: books,
  });
});
app.post("/delete", (req, res) => {
  var requestedBookName = req.body.bookName;
  var j = 0;
  books.forEach((book) => {
    j = j + 1;
    if (book.bookName == requestedBookName) {
      books.splice(j - 1, 1);
    }
  });
  res.render("home", {
    data: books,
  });
});
app.listen(port, () => {
  console.log(`Listening on http://localhost:${port}`);
});
