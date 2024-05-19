const mongoose = require("mongoose");
mongoose.connect("mongodb://localhost:27017/admin");
const db = mongoose.connection;
db.on("error", console.error.bind(console, "connection error : "));
db.once("open", function () {
  console.log("Connection successful");
});

var UserSchema = mongoose.Schema({
  name: String,
  username: { type: String, unique: true },
  password: String,
  email: { type: String, unique: true },
  mobile: { type: Number, unique: true },
  admin: { type: Boolean, default: false },
});

var BookSchema = mongoose.Schema({
  name: String,
  author: String,
  genre: String,
  type: String,
  available: { type: Boolean, default: true },
});

var BorrowerRecordSchema = mongoose.Schema(
  {
    username: String,
    BookId: { type: mongoose.ObjectId, unique: true, ref: "book" },
    duedate: {
      type: Date,
      default: () => new Date(+new Date() + 15 * 24 * 60 * 60 * 1000),
      required: "Must have duedate",
    },
  },
  {
    timestamps: true,
  }
);

var ReturnRecordSchema = mongoose.Schema(
  {
    username: String,
    bookId: { type: mongoose.ObjectId, unique: true, ref: "book" },
    duedate: { type: Date, ref: "BorrowerRecord" },
    find: Number,
  },
  {
    timestamps: true,
  }
);
var User = mongoose.model("User", UserSchema, "user");
var Book = mongoose.model("Book", BookSchema, "book");
var BorrowRecord = mongoose.model(
  "BorrowerRecord",
  BorrowerRecordSchema,
  "borrowers"
);
var ReturnRecord = mongoose.model(
  "ReturnRecord",
  ReturnRecordSchema,
  "returnrecords"
);
module.exports = { db, User, Book, BorrowerRecord, ReturnRecord };
