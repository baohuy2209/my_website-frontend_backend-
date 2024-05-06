var express = require("express");
var path = require("path");
const port = 3000;
const app = express();

var FILES_DIR = path.join(__dirname, "files");

app.get("/", function (req, res) {
  res.send(
    "<ul>" +
      '<li>Download <a href="/files/notes/groceries.txt">notes/groceries.txt</a>.</li>' +
      '<li>Download <a href="/files/amazing.txt">amazing.txt</a>.</li>' +
      '<li>Download <a href="/files/missing.txt">missing.txt</a>.</li>' +
      '<li>Download <a href="/files/CCTV大赛上海分赛区.txt">CCTV大赛上海分赛区.txt</a>.</li>' +
      "</ul>"
  );
});

app.get("/files/:file(*)", function (req, res) {
  res.download(req.params.file, { root: FILES_DIR }, function (err) {
    if (!err) {
      return;
    }
    if (err.status !== 404) {
      return next(err);
    }
    res.statusCode = 404;
    res.send("Can't find that file, sorry!");
  });
});

app.listen(port, (err) => {
  if (err) {
    console.log(err);
  }
  console.log(`listening on http://localhost:${port}`);
});
