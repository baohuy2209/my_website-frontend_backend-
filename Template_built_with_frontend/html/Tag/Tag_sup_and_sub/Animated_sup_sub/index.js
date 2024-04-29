const pug = require("pug");
const compiledFunction = pug.compileFile("index.pug");
const app = require("express")();
const port = 3000;

app.get("/", (req, res) => {
  res.send(compiledFunction);
});
app.listen(port, () => {
  console.log(`listening on http://localhost${port}`);
});
