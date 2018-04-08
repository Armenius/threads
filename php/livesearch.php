<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15.02.2018
 * Time: 12:49
 */

require_once 'bd.php';

$result = $mysqli->query("SELECT * FROM users 
              WHERE login LIKE '%".$_GET["q"]."%'
              OR email LIKE '%".$_GET["q"]."%' LIMIT 7");
$data = $result->fetch_all();
//$response = "<div class=\"friendsbar\" onclick=\"changeURL(document.getElementById('chat-frame'), '".$data[0][9]."')\">
//                <img src=\"../media/author-min.PNG\" class=\"friends-photo\">
//                <p class=\"friends-name\"> ".$data[0][1]." </p>
//                <p class=\"last-message\"> Hello, i wanna to tok with u </p>
//                </div>";
for($i = 0; $i < count($data); $i++){
    $response .= "<div class=\"friendsbar\">
                <img src=\"../media/".$data[$i][4]."\" class=\"friends-photo\">
                <p class=\"friends-name\">".$data[$i][1]."</p>
                <form class=\"last-message\" method='post' action='add_friend.php'>
                <input type='hidden' name='id' value='".$data[$i][0]."'> 
                <input type='submit' class='stylized-add-to-friends-btn' name='submit' value='Add to friends'> </form>
                </div>";
}

////if(){
//    $_POST["id"];
//    $mysqli->query("INSERT INTO relations(id_from, id_to, uuid, is_verified) VALUES ".$_SESSION['id'].", ".$_POST['id'].",'".gen_uuid()."', 0;");

echo $response;

?>