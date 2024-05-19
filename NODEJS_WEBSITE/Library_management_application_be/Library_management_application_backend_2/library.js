//library.js

const express = require("express");
var passport = require("passport");
var router = express.Router();
var { User, Book, BorrowerRecord, ReturnRecord } = require("./db");

//home endpoint
router.get("/", (req, res) => {
  res.send("Welcome To Library Management System");
});

//route for getting all books from database
router.get("/getbooks", async (req, res) => {
  const books = await Book.find({});
  res.send({ status: 200, books: books });
});

//route for getting all users from database
router.get("/getusers", async (req, res) => {
  const users = await User.find({});
  res.send({ status: 200, users: users });
});

//route for creating a new book
router.post("/createbook", async (req, res) => {
  //new book from request body
  var book = new Book(req.body);

  //authentication
  passport.authenticate("jwt", { session: false }, async (err, user) => {
    if (err || !user) {
      res.send({ status: 401, message: "Not Authorized" });
    } else {
      //checking if the user is admin
      if (user.admin) {
        //saving book to db
        await book.save().then(
          function (saveres) {
            if (saveres) {
              res.send({ status: 200, message: saveres });
            }
          },
          function (err) {
            res.send({
              status: 500,
              message: "Internal Server Error",
            });
          }
        );
      } else {
        res.send({
          status: 401,
          message: "You are not authorized to perform this action",
        });
      }
    }
  })(req, res);
});

//route for borrowing a new book
router.post("/borrowbook", async (req, res) => {
  //userid and bookid from request
  var bookid = req.body.bookid;
  var borrowerusername = req.body.username;

  //authentication
  passport.authenticate("jwt", { session: false }, async (err, user) => {
    // handle error
    if (err || !user) {
      res.send({ status: 401, message: "Not Authorized" });
    } else {
      // no error message
      // check if user is admin
      if (user.admin) {
        // check username
        User.findOne({ username: borrowerusername })
          .then((user) => {
            // promise
            console.log(user); // print user
            // check if user exists
            if (user) {
              // find book by id
              Book.findOne({ _id: bookid })
                .then((book) => {
                  console.log("book");
                  // check if books exist
                  if (book) {
                    // check if book is available in the database
                    if (book.available) {
                      //creating and saving new borrower record in database.

                      // create new object newBorrowerRecord
                      var newBorrowerRecord = new BorrowerRecord({
                        username: user.username,
                        bookid: book["_id"],
                      });
                      // save objec to database
                      newBorrowerRecord
                        .save()
                        .then((saveres) => {
                          // check exists
                          if (saveres) {
                            // find book by id
                            Book.where({
                              _id: book["_id"],
                            })
                              .updateOne({
                                // mutable property
                                available: false,
                              })
                              .then((updtres) => {
                                res.send({
                                  status: 200,
                                  message:
                                    "book borrowed successfully by " +
                                    user.username,
                                });
                              });
                          } else {
                            // print error message
                            res.send({
                              status: 500,
                              message: "Error Borrowing Book",
                            });
                          }
                        })
                        .catch((err) => {
                          res.send({
                            status: 500,
                            message: "Error Borrowing Book",
                          });
                        });
                    } else {
                      res.send({
                        status: 500,
                        message: "Book Is not available",
                      });
                    }
                  } else {
                    res.send({
                      status: 500,
                      message: "Book with Id Does Not Exist",
                    });
                  }
                })
                .catch((err) => {
                  res.send({
                    status: 500,
                    message: "Internal Server Error",
                  });
                });
            } else {
              res.send({
                status: 500,
                message: "Borrower Does Not Exist",
              });
            }
          })
          .catch((err) => {
            res.send({
              status: 500,
              message: "Internal Server Error",
            });
          });
      } else {
        res.send({
          status: 401,
          message: "You are not authorized to perform this action",
        });
      }
    }
  })(req, res);
});

//route for returning a book
router.post("/returnbook", async (req, res, next) => {
  var bookid = req.body.bookid;
  var borrowerusername = req.body.username;

  //authentication
  passport.authenticate("jwt", { session: false }, async (err, user) => {
    if (err || !user) {
      res.send({ status: 401, message: "Not Authorized" });
    } else {
      if (user.admin) {
        //checking for existance of borrower record in db
        BorrowerRecord.findOne({
          bookid: bookid,
          username: borrowerusername,
        })
          .then((borrowrec) => {
            if (borrowrec) {
              var todaysdate = new Date().toISOString();

              //calculation of fine if delayed in returning
              const fine = 0;
              if (todaysdate > borrowrec.submitdate) {
                const diffTime = Math.abs(todaysdate - borrowrec.submitdate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                fine = diffDays * 2;
              }

              //creating and saving new return record.
              var returnrec = new ReturnRecord({
                username: borrowerusername,
                bookid: bookid,
                duedate: borrowrec.submitdate,
                fine: fine,
              });

              returnrec
                .save()
                .then((saveres) => {
                  if (saveres) {
                    Book.findOne({ _id: bookid })
                      .updateOne({ available: true })
                      .then((updtres) => {
                        if (updtres) {
                          res.send({
                            status: 200,
                            message: "Book Returned Successfully",
                          });
                        } else {
                          res.send({
                            status: 500,
                            message: "Error Creating Return Record",
                          });
                        }
                      });
                  } else {
                    res.send({
                      status: 500,
                      message: "Error Creating Return Record",
                    });
                  }
                })
                .catch((err) => {
                  res.send({
                    status: 500,
                    message: "Internal Server Error",
                  });
                });
            } else {
              res.send({
                status: 500,
                message: "No Record Found",
              });
            }
          })
          .catch((err) => {
            res.send({
              status: 500,
              message: "Internal Server Error",
            });
          });
      } else {
        res.send({
          status: 401,
          message: "You are not authorized to perform this action",
        });
      }
    }
  })(req, res);
});

//route for paying fine
router.post("/payfine", (req, res) => {
  //return record id from request.
  var returnrecid = req.body.returnrecordid;

  //authentication
  passport.authenticate("jwt", { session: false }, async (err, user) => {
    if (err || !user) {
      res.send({ status: 401, message: "Not Authorized" });
    } else {
      if (user.admin) {
        //paying fine by updating return record in database.
        ReturnRecord.findOne({ _id: returnrecid })
          .updateOne({ fine: 0 })
          .then((updtres) => {
            if (updtres) {
              res.send({
                status: 200,
                message: "Fine Paid Successfully",
              });
            } else {
              res.send({
                status: 500,
                message: "Error paying Fine",
              });
            }
          })
          .catch((err) => {
            res.send({
              status: 500,
              message: "Internal Server Error",
            });
          });
      } else {
        res.send({
          status: 401,
          message: "You are not authorized to perform this action",
        });
      }
    }
  })(req, res);
});

module.exports = router;
