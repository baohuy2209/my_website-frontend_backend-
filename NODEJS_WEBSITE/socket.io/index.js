const express = require("express");
const app = express();
const port = 3000;
const server = app.listen(port, () => {
  console.log(
    `Socket.io Hello world server started. Listening on port http://localhost:${port}`
  );
});
const io = require("socket.io")(server);

io.on("connection", (socket) => {
  socket.on("message-from-client-to-server", (msg) => {
    console.log(msg);
  });
  socket.emit("message-from-server-to-client", "Hello world!");
});
