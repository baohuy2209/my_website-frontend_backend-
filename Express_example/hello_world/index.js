var express = require("express");
var app = express();
app.get("/", function (req, res) {
  res.send("Hello, world");
});
const port = 3000;
app.listen(port, () => {
  console.log(`Listening on http://localhost:${port}`);
});
