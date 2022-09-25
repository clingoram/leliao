// socket io
const express = require('express');
const app = express();
const http = require('http');
const server = http.createServer(app);

const io = require('socket.io')(server, {
  cors: { origin: "*" }
});

io.on('connection', (socket) => {
  console.log('A user is connected.');

  socket.on('disconnect', (socket) => {
    console.log('Disconnect');
  })
});

// cmd : node server
server.listen(3000, () => {
  console.log('Server is running.Listening on *:3000');
})