var cookieSession = require("cookie-session");
var express = require("express");
var app = express();
const port = 3000;
app.use(
  cookieSession({
    secret: "many is cool",
  })
);
app.get("/", function (req, res) {
  res.session.count = (res.session.count || 0) + 1;
  res.send("viewed" + req.session.count + "times\n");
});
app.listen(port, () => {
  console.log(`Listening on port http://localhost:${port}`);
});
