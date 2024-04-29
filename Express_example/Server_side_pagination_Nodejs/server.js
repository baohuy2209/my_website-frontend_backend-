const app = require("express")();
const port = process.env.PORT || 3000;
const db = require("./app/models");
const route = require("./app/routes/tutorial.routes");
db.mongoose
  .connect(db.url, {
    useNewUrlParser: true,
    useUnifiedTopology: true,
  })
  .then(() => {
    console.log("Connected to the database!");
  })
  .catch((err) => {
    console.log("Cannot connect to the database!", err);
    process.exit();
  });
route(app);
app.listen(port, () => {
  console.log(`Listening on http://localhost:${port}`);
});
