const express = require("express");
const dotenv = require("dotenv");
const app = express();
const port = process.env.PORT || 5000;
const db = require("./config/db/index");
db.connectDB();
dotenv.config();
app.use(express.json());
app.use(
  express.urlencoded({
    extended: true,
  })
);
app.use(require("./middleware/errorHandler"));
app.use("/api/contacts", require("./routes/contacts.routes"));
app.use("/api/user", require("./routes/user.routes"));
app.listen(port, () => {
  console.log(`Listening on http://localhost:${port}`);
});
