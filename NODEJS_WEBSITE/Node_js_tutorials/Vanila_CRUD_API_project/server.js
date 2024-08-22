const http = require("http");
const getReq = require("./methods/get-request");
const postReq = require("./methods/post-request");
const putReq = require("./methods/put-request");
const deleteReq = require("./methods/delete-request");
const dotenv = require("dotenv");
dotenv.config();
let movies = require("./data/movie.json");
const PORT = process.env.PORT || 5001;
const server = http.createServer((req, res) => {
  req.movies = movies;
  switch (req.method) {
    case "GET":
      getReq(req, res);
      break;
    case "POST":
      postReq(req, res);
      break;
    case "PUT":
      putReq(req, res);
      break;
    case "DELETE":
      deleteReq(req, res);
      break;
    default:
      res.statusCode = 400;
      res.setHeader("Content-Type", "application/json");
      res.write(
        JSON.stringify({ title: "Not found", message: "Route not found" })
      );
      res.end();
  }
});
server.listen(PORT, () => {
  console.log(`Listening on http://localhost:${PORT}`);
});
