// socket io
// const express = require('express');
// const app = express();
// const http = require('http');
// const server = http.createServer(app);

// const io = require('socket.io')(server, {
//   cors: { origin: "*" }
// });

// io.on('connection', (socket) => {
//   console.log('A user is connected.');

//   socket.on('disconnect', (socket) => {
//     console.log('Disconnect');
//   })
// });

// // cmd : node server
// server.listen(3000, () => {
//   console.log('Server is running.Listening on *:3000');
// })

var Redis = require('ioredis');
var redis = new Redis();
// 訂閱 redis 的new-channel-name頻道，也就是我們在事件中 broadcastOn 所設定的
redis.subscribe('new-channel-name', function (err, count) {
  console.log('connect!');
});
// 當該頻道接收到訊息時就列在 terminal 上
redis.on('message', function (channel, notification) {
  console.log(notification);
});