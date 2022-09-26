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

io.on('message', function (channel, notification) {
  console.log(notification);

  notification = JSON.parse(notification);
  // 將訊息推播給使用者
  io.emit('notification', notification.data.message);
});

// cmd : node server
server.listen(3000, () => {
  console.log('Server is running.Listening on *:3000');
})


// 'use strict';
// var app = require('express')();
// var server = require('http').Server(app);
// var io = require('socket.io')(server);
// require('dotenv').config();

// var redisPort = process.env.REDIS_PORT;
// var redisHost = process.env.REDIS_HOST;
// var ioRedis = require('ioredis');
// var redis = new ioRedis(redisPort, redisHost);
// redis.subscribe('action - channel - one');
// redis.on('message', function (channel, message) {
//   message = JSON.parse(message);
//   io.emit(channel + ':' + message.event, message.data);
// });

// var broadcastPort = process.env.BROADCAST_PORT;
// server.listen(broadcastPort, function () {
//   console.log('Socket server is running.');
// });