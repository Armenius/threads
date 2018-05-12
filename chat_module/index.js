// 'use strict';

// var app = require('express')();
 var http = require('http');
// var io = require('socket.io')(http);
var nodeStatic = require('node-static');
var socketIO = require('socket.io');
var fileServer = new(nodeStatic.Server)();


// var server = http.createServer();
// server.setSecure(credentials);
// server.addListener("request", handler);
// server.listen(8000);;

// var redirectToHTTPS = require('express-http-to-https').redirectToHTTPS;
// var express = require('express');
// var app = express();
// app.use(redirectToHTTPS([/localhost:(\d{4})/], [/\/insecure/], 301));
//
// app.get('/', function (req, res) {
//     res.send('Hello World!');
// });
//
// app.get('/insecure', function (req, res) {
//     res.send('Dangerous!');
// });
//
// app.listen(3000, function () {
//     console.log('Example app listening on port 3000!');
// });
//
// app.listen(8080, function () {
//     console.log('Example app listening on port 8080 insecurely!');
// });

const https = require('https');
const fs = require('fs');
//
// const options = {
//     key: fs.readFileSync('client-key.pem'),
//     cert: fs.readFileSync('test/fixtures/keys/agent2-cert.pem')
// };
//
// https.createServer(options, function(req, res){
//     res.writeHead(200);
//     res.end('hello world\n');
// }).listen(8443);

// https.createServer(options, (req, res) => {
//     res.writeHead(200);
// res.end('hello world\n');
// }).listen(8000);

var options = {
    key: fs.readFileSync('ssl/privatekey.pem'),
    cert: fs.readFileSync("ssl/certificate.pem")
};

// WORKING HTTPS
var app = https.createServer(options, function(req, res){
    fileServer.serve(req, res);
    console.log('Listening on *:8080');
}).listen(8080);

var io = socketIO.listen(app);

io.sockets.on('connection', function(socket){
    // var arr = 'asd32das2131';
    // var room_arr = ['some_room', 'another_room'];
    // room = prompt('Enter room name:');
    // var room = room_arr[Math.round(Math.random())];
    // if(uuid)
    //     arr = uuid;
    // var doc = document.getElementById("server");
    // arr = doc.dataset.src;

    // console.log(global.uuid);
    var room = 'hello';
    console.log('a user connected to room - ', room);

    socket.join(room);

    socket.on('disconnect', function(){
        console.log('user disconnected');
    });

    socket.on('chat message', function(msg){
        var socket_id = socket.id;
        io.to(room).emit('chat message', msg, socket_id);
    });


    // START BLOCK FOR VIDEOCHAT //////////////////////////////////
    function log() {
        var array = ['Message from server:'];
        array.push.apply(array, arguments);
        socket.emit('log', array);
    }

    socket.on('send message', function(message) {
        log('Client send a message: ', message);
        // for a real app, would be room-only (not broadcast)
        socket.broadcast.emit('message', message);
    });

    socket.on('message', function(message) {
        log('Client said: ', message);
        // for a real app, would be room-only (not broadcast)
        socket.broadcast.emit('message', message);
    });

    socket.on('create or join', function(room) {
        log('Received request to create or join room ' + room);

        var clientsInRoom = io.sockets.adapter.rooms[room];
        var numClients = clientsInRoom ? Object.keys(clientsInRoom.sockets).length : 0;

        log('Room ' + room + ' now has ' + numClients + ' client(s)');

        if (numClients === 0) {
            socket.join(room);
            log('Client ID ' + socket.id + ' created room ' + room);
            socket.emit('created', room, socket.id);

        } else if (numClients === 1) {
            log('Client ID ' + socket.id + ' joined room ' + room);
            io.sockets.in(room).emit('join', room);
            socket.join(room);
            socket.emit('joined', room, socket.id);
            io.sockets.in(room).emit('ready');
        } else { // max two clients
            socket.emit('full', room);
        }
    });

    socket.on('ipaddr', function() {
        var ifaces = os.networkInterfaces();
        for (var dev in ifaces) {
            ifaces[dev].forEach(function(details) {
                if (details.family === 'IPv4' && details.address !== '127.0.0.1') {
                    socket.emit('ipaddr', details.address);
                }
            });
        }
    });

    // END BLOCK FOR VIDEOCHAT////////////////////////////////////////////////////////////////
});
