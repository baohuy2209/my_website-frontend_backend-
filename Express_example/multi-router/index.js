var express = require("express");
var app = express();
const port = 3000;
app.use("/api/v1", require("./controllers/api_v1"));
app.use("/api/v2", require("./controllers/api_v2"));

app.get("/", function (req, res) {
  res.send("Hello from root route");
});
app.listen(port, () => {
  console.log(`Listening on port http://localhost:${port}`);
});
