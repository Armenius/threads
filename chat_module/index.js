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

var arr = 0;

io.on('connection', function(socket){
    // var room_arr = ['some_room', 'another_room'];
    // // room = prompt('Enter room name:');
    // var room = room_arr[Math.round(Math.random())];
    var room = arr;
    console.log('a user connected to room - ', room);

    socket.join(room);

    socket.on('disconnect', function(){
        console.log('user disconnected');
    });

    socket.on('chat message', function(msg){
        var socket_id = socket.id;
        io.to(room).emit('chat message', msg, socket_id);
    });
});
