var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

app.get('/', function(req, res){
    res.sendFile(__dirname + '/chat.html');
});

io.on('connection', function(socket){
    console.log('a user connected');

    var room = 'some_room';
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

http.listen(8000, function(){
    console.log('listening on *:8000');
});
