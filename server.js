// socket io - server side.
// var app = require('express')();
// var server = require('http').Server(app);
// var io = require('socket.io')(server);
// var Redis = require('ioredis');
// const redis = new Redis();

// var redisClient = redis.createClient();
// io.on('connection', function (socket) {

//   console.log('Redis client connected');

//   // redisClient.subscribe('message');

//   // redisClient.on("message", function (channel, data) {
//   //   socket.emit(channel, data);
//   // });

//   redisClient.subscribe('sendChatToServer');

//   redisClient.on("sendChatToServer", function (channel, data) {
//     socket.emit(channel, data);
//   });

//   socket.on('disconnect', function () {
//     redisClient.quit();
//   });
// });

// server.listen(3000, function () {
//   console.log('Server is running.Listening on *:3000');
// });

// 'use strict';
// const express = require('express');
// const app = express();
// const http = require('http');
// const server = http.createServer(app);

// // const redisPort = process.env.REDIS_PORT;
// // const redisHost = process.env.REDIS_HOST;

// // Import ioredis.
// const Redis = require('ioredis');
// // Create a Redis instance.
// const redis = new Redis(6379);
// // const redis = new Redis(redisPort, redisHost);

// const io = require('socket.io')(server, {
//   cors: {
//     origin: "*"
//   }
// });

// require('dotenv').config();

// redis.subscribe('public-chat');

// redis.on('sendChatToServer', function (channel, message) {
//   console.log(message);

//   message = JSON.parse(message);
//   io.emit(channel + ':' + message.event, message.data);
// });


// maybe remove dotenv、ioredis
// io.on('connection', function (socket) {
//   console.log(socket.connected); // true means connected
//   console.log('Connected! Socket id is: ' + socket.id);

//   socket.on('sendChatToServer', function (message) {
//     console.log(message);

//     io.sockets.emit('sendChatToClient', message);
//     // socket.broadcast.emit('sendChatToClient', message);
//   });

//   // 來自client 的事件名稱
//   socket.on('disconnect', function (socket) {
//     console.log('Disconnect');
//   })
// });

// io.on("connect_error", function (socket) {
//   socket.auth.token = "abcd";
//   socket.connect();
// });

// io.on('message', function (channel, message) {
//   console.log(message);
//   console.log(channel);
//   message = JSON.parse(message);
//   // 將訊息推播給使用者
//   // 要對所有 Client 廣播的事件名稱
//   io.emit('notification', message.data.message);
// });

// cmd : node server
// server.listen(3000, function () {
//   console.log('Server is running.Listening on *:3000');
// });



// // var app = require('express')();
// // var server = require('http').Server(app);
// // var io = require('socket.io')(server);
// // require('dotenv').config();

// // var redisPort = process.env.REDIS_PORT;
// // var redisHost = process.env.REDIS_HOST;
// // var ioRedis = require('ioredis');
// // var redis = new ioRedis(redisPort, redisHost);

// // redis.subscribe('public-chat');

// // redis.on('sendChatToServer', function (channel, message) {
// //   console.log(message);

// //   message = JSON.parse(message);
// //   io.emit(channel + ':' + message.event, message.data);
// // });

// // // var broadcastPort = process.env.BROADCAST_PORT;
// // var broadcastPort = 3000;
// // server.listen(broadcastPort, function () {
// //   console.log('Socket server is running.');
// // });


// -----------
var app = require('express');
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis();

// Testevent channel's name
redis.subscribe('my-channel', function (err, count) {
  console.log('connect!');
});
redis.on('message', function (channel, notification) {
  console.log(notification);

  notification = JSON.parse(notification);
  // 將訊息推播給使用者
  io.emit('notification', notification.data.message);
});
// 監聽 3000 port
http.listen(3000, function () {
  console.log('Listening on Port 3000');
});