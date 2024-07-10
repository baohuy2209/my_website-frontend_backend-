const express = require("express");
const cors = require("cors");
const bodyParser = require("body-parser");
const app = express();
const PORT = process.env.PORT || 5000;
const db = require("./config/db/index");
const route = require("./routes/index.routes");
db.connectDB();
app.use(cors());
app.use(bodyParser.json());
route(app);
app.listen(PORT, () => {
  console.log(`Listening on http://localhost:${PORT}/api`);
});
