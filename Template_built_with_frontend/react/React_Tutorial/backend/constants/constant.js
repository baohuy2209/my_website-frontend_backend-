const client_error = require("./client_error");
const server_error = require("./server_error");
module.exports = { ...client_error, ...server_error };
