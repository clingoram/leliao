// socket io - server side.
'use strict';
const express = require('express');
const app = express();
const http = require('http');
const server = http.createServer(app);

// const http = require('http');
// const server = http.createServer(app);
// const { Server } = require("socket.io");
// const io = new Server(server);

const io = require('socket.io')(server, {
  cors: { origin: "*" }
});

// require('dotenv').config();

// maybe remove dotenv、ioredis
io.on('connection', function (socket) {
  // console.log('A user is connected.');
  console.log(socket.connected); // true means connected
  console.log('Connected! Socket id is: ' + socket.id);

  socket.on('sendChatToServer', function (message) {
    console.log(message);

    // io.sockets.emit('sendChatToClient', message);
    socket.broadcast.emit('sendChatToClient', message);
  });

  // 來自client 的事件名稱
  socket.on('disconnect', function (socket) {
    console.log('Disconnect');
  })
});

io.on("connect_error", function (socket) {
  socket.auth.token = "abcd";
  socket.connect();
});

// io.on('message', function (channel, message) {
//   console.log(message);
//   console.log(channel);
//   message = JSON.parse(message);
//   // 將訊息推播給使用者
//   // 要對所有 Client 廣播的事件名稱
//   io.emit('notification', message.data.message);
// });

// cmd : node server
server.listen(3000, function () {
  console.log('Server is running.Listening on *:3000');
});



// const redisPort = process.env.REDIS_PORT;
// const redisHost = process.env.REDIS_HOST;

// import redis
// const ioRedis = require('ioredis');
// Create a Redis instance.
// By default, it will connect to localhost:6379.
// We are going to cover how to specify connection options soon.
// const redis = new ioRedis(redisPort, redisHost);

// redis.subscribe('action - channel - one');
// redis.on('message', function (channel, message) {
//   console.log(message);
//   message = JSON.parse(message);
//   // 將訊息推播給使用者
//   io.emit(channel + ':' + message.event, message.data);
// });

// const broadcastPort = process.env.BROADCAST_PORT;
// server.listen(broadcastPort, function () {
//   console.log('Socket server is running on' + broadcastPort);
// });