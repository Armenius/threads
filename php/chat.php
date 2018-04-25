<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11.02.2018
 * Time: 15:29
 */
session_start();

require_once 'bd.php';

?>

<html>
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>-->
    <script src="../js/main.js"></script>
    <script src="../js/particles.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
    <script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
<!--    <link rel="stylesheet" href="../css/style.css">-->
    <link rel="stylesheet" href="../css/chat.css">
<body>
<!--        <span class="chat-cloud"> <strong onload="showHint(this.value)">  </strong>  asdsaaaaaaaaaaaaaaaaaaaaaaaaaaaa </span>-->
<!--        <span class="chat-cloud"> <strong> Parmenion: </strong>  asdsaaaaaaaaaaaaaaaaaaaaaaaaaaaa </span>-->
<!--        <p class="chat-cloud"> <strong> Parmenion: </strong>  asdsaaaaaaaaaaaaaaaaaaaaaaaaaaaa </p>-->
<!--        <span class="chat-cloud"> Parmenion want's to chat: <form> <input type="button" value="Accept">  </input> <input type="button" value="Decline"> </input> </form> </span>-->
<!--        <span class="chat-cloud"> <strong> Parmenion: </strong>  asdsaaaaaaaaaaaaaaaaaaaaaaaaaaaa </span>-->
<!--        <span class="chat-cloud"> <strong> Parmenion: </strong>  asdsaaaaaaaaaaaaaaaaaaaaaaaaaaaa </span>-->
<!--        <p class="chat-cloud"> <strong> Parmenion: </strong>  asdsaaaaaaaaaaaaaaaaaaaaaaaaaaaa </p>-->
<!--        <span class="chat-cloud"> Parmenion want's to chat: <form> <input type="button" value="Accept">  </input> <input type="button" value="Decline"> </input> </form> </span>-->
<!--        <span class="chat-cloud"> <strong> Parmenion: </strong>  asdsaaaaaaaaaaaaaaaaaaaaaaaaaaaa </span>-->
<!--        <span class="chat-cloud"> <strong> Parmenion: </strong>  asdsaaaaaaaaaaaaaaaaaaaaaaaaaaaa </span>-->
<!--        <p class="chat-cloud"> <strong> Parmenion: </strong>  asdsaaaaaaaaaaaaaaaaaaaaaaaaaaaa </p>-->
<!--        <span class="chat-cloud"> Parmenion want's to chat: <form> <input type="button" value="Accept">  </input> <input type="button" value="Decline"> </input> </form> </span>-->
<!--        <span class="chat-cloud"> <strong> Parmenion: </strong>  asdsaaaaaaaaaaaaaaaaaaaaaaaaaaaa </span>-->
<!--        <span class="chat-cloud"> <strong> Parmenion: </strong>  asdsaaaaaaaaaaaaaaaaaaaaaaaaaaaa </span>-->
<!--        <p class="chat-cloud"> <strong> Parmenion: </strong>  asdsaaaaaaaaaaaaaaaaaaaaaaaaaaaa </p>-->
<!--        <span class="chat-cloud"> Parmenion want's to chat: <form> <input type="button" value="Accept">  </input> <input type="button" value="Decline"> </input> </form> </span>-->
<!--        <span class="chat-cloud"> <strong> Parmenion: </strong>  asdsaaaaaaaaaaaaaaaaaaaaaaaaaaaa </span>-->
<!--        <span class="chat-cloud"> <strong> Parmenion: </strong>  asdsaaaaaaaaaaaaaaaaaaaaaaaaaaaa </span>-->
<!--        <p class="chat-cloud"> <strong> Parmenion: </strong>  asdsaaaaaaaaaaaaaaaaaaaaaaaaaaaa </p>-->
<!--        <span class="chat-cloud"> Parmenion want's to chat: <form> <input type="button" value="Accept">  </input> <input type="button" value="Decline"> </input> </form> </span>-->

<!--            <div class="send-message-box">-->
<!--                <form action="">-->
<!--                    <textarea id="m" class="text-box"> </textarea>-->
<!--                    <button id="send-button" type="button" class="btn btn-default btn-sm">-->
<!--                        <span id="send-button" class="glyphicon glyphicon-send"></span> Send-->
<!--                    </button>-->
<!--                </form>-->
<!--            </div>-->

<!--    <div class="menu">-->
<!--        <div class="back"><i class="fa fa-chevron-left"></i> <img src="https://i.imgur.com/DY6gND0.png" draggable="false"/></div>-->
<!--        <div class="name">Alex</div>-->
<!--        <div class="last">18:09</div>-->
<!--    </div>-->
    <ul class="chat-thread" id="messages">
        <?  $result = $mysqli->query("SELECT * FROM `users` INNER JOIN `relations` ON users.id = relations.id_from WHERE uuid='".$_GET['uuid']."' AND relations.id_to=".$_SESSION['id'].";");
            $data = $result->fetch_all(PDO::FETCH_ASSOC);
            for($i = 0; $i < count($data); $i++) {
                if($data[$i][10] == 0)
                    echo "<li class=\"msg-from\">".$data[$i][1]." want to chat with you: <form method='post' action='verify_friend_req.php?uuid=".$_GET['uuid']."&fid=".$data[$i][0]."'> <input type='submit' name='Accept' class='accept-friends-req' value='ACCEPT'> </form> </li>";
            }
        ?>
        <li class="msg-from">Are we meeting today?</li>
        <li class="msg-to">yes, what time suits you?</li>
        <li class="msg-from">I was thinking after lunch, I have a meeting in the morning</li>
        <li class="msg-to">Are we meeting today?</li>
        <li class="msg-to">yes, what time suits you?</li>
        <li class="msg-from">I was thinking after lunch, I have a meeting in the morning</li>
        <li class="msg-to">Are we meeting today?</li>
        <li class="msg-to">yes, what time suits you?</li>
        <li class="msg-to">I was thinking after lunch, I have a meeting in the morning</li>
        <li class="msg-from">Are we meeting today?</li>
        <li class="msg-to">yes, what time suits you?</li>
        <li class="msg-to">I was thinking after lunch, I have a meeting in the morning</li>
        <li class="msg-to">Are we meeting today?</li>
        <li class="msg-from">yes, what time suits you?</li>
        <li class="msg-to">I was thinking after lunch, I have a meeting in the morningI was thinking after lunch, I have a meeting in the morningI was thinking after lunch, I have a meeting in the morningI was thinking after lunch, I have a meeting in the morningI was thinking after lunch, I have a meeting in the morningI was thinking after lunch, I have a meeting in the morningI was thinking after lunch, I have a meeting in the morningI was thinking after lunch, I have a meeting in the morningI was thinking after lunch, I have a meeting in the morningI was thinking after lunch, I have a meeting in the morning</li>
        <li class="msg-from">I was thinking after lunch, I have a meeting in the morningI was thinking after lunch, I have a meeting in the morningI was thinking after lunch, I have a meeting in the morningI was thinking after lunch, I have a meeting in the morningI was thinking after lunch, I have a meeting in the morningI was thinking after lunch, I have a meeting in the morningI was thinking after lunch, I have a meeting in the morningI was thinking after lunch, I have a meeting in the morning</li>
        <li class="msg-from">yes, what time suits you?</li><li class="msg-from">yes, what time suits you?</li><li class="msg-from">yes, what time suits you?</li><li class="msg-from">yes, what time suits you?</li>

    </ul>

    <div class="group">
        <input id="m" type="text" class="enter-msg-box" required>
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Enter message</label>
        <i class="glyphicon glyphicon-earphone call"></i>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>

    <script>

        $(function () {
            var socket = io();
            $('form').submit(function(){
                socket.emit('chat message', $('#m').val());
                $('#m').val('');
                return false;
            });
            socket.on('chat message', function(msg){
                $('#messages').append($('<li style="margin-left: 300px">').text(msg));
            });
        });
    </script>


        <script>
            function showHint(str) {
                if (str.length == 0) {
                    document.getElementById("txtHint").innerHTML = "";
                    return;
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("txtHint").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "test.php?str=" + str, true);
                    xmlhttp.send();
                }
            }



        </script>
    </body>
</html>

<?
    $mysqli->close();
?>