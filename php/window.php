<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12.02.2018
 * Time: 23:36
 */
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Welcome to THREADs </title>
    <link rel="shortcut icon" href="http://www.images.pajezy.com/notes/thread.png" type="image/png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">

    <script src="../js/main.js"></script>
<!--    <script src="../js/particles.min.js"></script>-->
</head>
<body>

<!--<nav class="navbar navbar-fixed-top menu">-->
<!--<div class="container-fluid">-->
<!--<div class="navbar-header">-->
<!--<a class="navbar-brand" href="index.html"> THREADs </a>-->
<!--</div>-->
<!--<ul class="nav navbar-nav">-->
<!--&lt;!&ndash;<li class="active"><a href="#"> Home </a></li>&ndash;&gt;-->
<!--<li><a href="#">Greetings page</a></li>-->
<!--<li><a href="#">About authors</a></li>-->
<!--</ul>-->
<!--<ul class="nav navbar-nav navbar-right">-->
<!--<li><a href="registrate.html"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
<!--<li><a href="login.html"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>-->
<!--</ul>-->
<!--</div>-->
<!--</nav>-->


<!--<div class="parallax">-->
<div class="user-content">
<!--    <div class="userbar">-->
<!--        <img src="../media/--><?// echo $_SESSION['photo']; ?><!-- " class="users-photo">-->
<!--        <p class="users-name"> --><?// echo $_SESSION['login']; ?><!-- </p>-->
<!--    </div>-->

    <div class="searchbar">
        <div class="group">
            <input type="text" id="search" name="search" placeholder="Search for..." class="stylized-input" onkeyup="showResult(this.value)">
            <span class="highlight"></span>
            <span class="bar"></span>
        </div>
        <div id="livesearch" class="livesearch"></div>
    </div>

    <div class="friends-box" id="friends-box">
        <? require_once 'bd.php';
//            echo $_SESSION['id'];
            $result = $mysqli->query("SELECT * FROM `users` INNER JOIN `relations` ON users.id = relations.id_to WHERE relations.id_from=".$_SESSION["id"]." UNION SELECT * FROM `users` INNER JOIN `relations` ON users.id = relations.id_from WHERE relations.id_to=".$_SESSION["id"].";");
            $data = $result->fetch_all();
            for($i = 0; $i < count($data); $i++){
                if($data[$i][10] == 0){
                    echo "<div class=\"friendsbar\" onclick=\"changeURL(document.getElementById('chat-frame'), '".$data[$i][9]."')\">
                    <img src=\"../media/".$data[$i][4]."\" class=\"friends-photo\">
                    <p class=\"friends-name\"> ".$data[$i][1]." </p> <div style='width: 7px; height: 7px; border-radius: 7px; background: #0EC879; position: absolute; margin-left: 95%; margin-top: 30px'></div>
                    <p class=\"last-message\"> Hello, i wanna to tok with u </p>
                </div>";
                }
                else{
                echo "<div class=\"friendsbar\" onclick=\"changeURL(document.getElementById('chat-frame'), '".$data[$i][9]."')\">
                <img src=\"../media/".$data[$i][4]."\" class=\"friends-photo\">
                <p class=\"friends-name\"> ".$data[$i][1]." </p>
                <p class=\"last-message\"> Hello, i wanna to tok with u </p>
            </div>";
                }
            }
        ?>
<!--            <div class="friendsbar" onclick="changeURL(document.getElementById('chat-frame'), 'kek')">-->
<!--                <img src="../media/author-min.PNG" class="friends-photo">-->
<!--                <p class="friends-name"> Parmenion </p>-->
<!--                <p class="last-message"> Hello, i wanna to tok with u </p>-->
<!--            </div>-->
    </div>
</div>

<iframe class="chat-box" id="chat-frame" src=""> </iframe>
<!--</div>-->

<script>
    function changeURL(frame, uuid){
        frame.src = "../php/chat.php?uuid=" + uuid;
    }

    function showResult(str) {
        if (str.length==0) {
            document.getElementById("livesearch").innerHTML="";
            $("#friends-box").show();
            return;
        }
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        } else {  // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                document.getElementById("livesearch").innerHTML=this.responseText;
                document.getElementById("livesearch").style.border="0";
            }
        }
        xmlhttp.open("GET","livesearch.php?q="+str,true);
        xmlhttp.send();
        $("#friends-box").hide();
    }
</script>

</body>
</html>
<? $mysqli->close(); ?>