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
// const redis = new Redis();
// // const redis = new Redis(redisPort, redisHost);

// const client = redis.createClient({
//   host: "redis-server",
//   port: 6379
// });
// client.connect();
// client.on('connect', (err) => {
//   if (err) throw err;
//   else console.log('Redis Connected..!');
// });


// const io = require('socket.io')(server, {
//   cors: {
//     origin: "*"
//   }
// });

// require('dotenv').config();

// client.subscribe('public-chat');

// client.on('sendChatToServer', function (channel, message) {
//   console.log(message);

//   message = JSON.parse(message);
//   io.emit(channel + ':' + message.event, message.data);
// });


// // redis.subscribe('public-chat');

// // redis.on('sendChatToServer', function (channel, message) {
// //   console.log(message);

// //   message = JSON.parse(message);
// //   io.emit(channel + ':' + message.event, message.data);
// // });


// // maybe remove dotenv、ioredis
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

// // cmd : node server
// server.listen(3000, function () {
//   console.log('Server is running.Listening on *:3000');
// });

