'use strict';

// var app = require('express')();
var http = require('http');
// var io = require('socket.io')(http);
var nodeStatic = require('node-static');
var socketIO = require('socket.io');
var fileServer = new(nodeStatic.Server)();
var app = http.createServer(function(req, res) {
    fileServer.serve(req, res);
    console.log('Listening on *:8080');
}).listen(8080);
var io = socketIO.listen(app);
// app.get('/', function(req, res){
//     res.sendFile(__dirname + '/index.html');
// });

io.on('connection', function(socket){
    var room_arr = ['some_room', 'another_room'];
    // room = prompt('Enter room name:');
    var room = room_arr[Math.round(Math.random())];
    console.log('a user connected to room - ', room);
    // socket.on('connect', function () {
    //    socket.emit('room', room);
    //    console.log('Connected to the room - ', room)
    // });
    //
    // socket.on('room', function(room) {
    //     socket.join(room);
    // });
    // console.log(socket.join(room));

    socket.join(room);

    socket.on('disconnect', function(){
        console.log('user disconnected');
    });

    socket.on('chat message', function(msg){
        io.to(room).emit('chat message', msg);
    });
});

// http.listen(3000, function(){
//     console.log('listening on *:3000');
// });

