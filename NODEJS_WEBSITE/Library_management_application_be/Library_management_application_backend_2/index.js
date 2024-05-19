const express = require("express");
const bodyParser = require("body-parser");
var session = require("express-session");
const MongoStore = require("connect-mongo");
const port = 3000;
const app = express();
var { db } = require("./db");
var authRouter = require("./auth");
var libraryRouter = require("./library");

app.use(bodyParser.json());
app.use(
  bodyParser.urlencoded({
    extended: true,
  })
);

app.use(
  session({
    secret: "gfgsecret",
    resave: false,
    saveUninitialized: true,
    store: MongoStore.create({
      client: db.getClient(),
      dbName: "testdb",
      collectionName: "sessions",
      stringify: "interval",
      autoRemove: "interval",
      autoRemoveInterval: 1,
    }),
  })
);
app.use("/", authRouter);
app.use("/", libraryRouter);

app.listen(port, () => {
  console.log(`Listening on http://localhost:${port}`);
});
