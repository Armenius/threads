<?php
/**
 * Created by PhpStorm.
 * User: parmenion
 * Date: 21.11.17
 * Time: 13:18
 */
    require_once 'bd.php';
    $_POST['email'];
    $_POST['name'];
    $_POST['password'];
    $_POST['passwordAgain'];
//    $_POST['photo'];


if($_POST['password'] != $_POST['passwordAgain']){
        echo '<script>location.replace("../templates/unsuccess.html");</script>'; exit;
    }
    else{
        mkdir("C:\\Users\\".getenv("username")."\\Downloads\\Threads\\");  // create folder for private keys

        if ($mysqli->connect_errno) {
            printf("Error during connection: %s\n", $mysqli->connect_error);
            exit();
        }

        $uploaddir = '..\\media\\';

        $ext = array_pop(explode('.',$_FILES['photo']['name'])); // расширение
        $new_name = time().'.'.$ext; // новое имя с расширением
        $full_path = $uploaddir.$new_name;

        echo '<pre>';
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $full_path)) {
            echo "Yes\n";
        } else {
            echo "No\n";
        }

//        echo 'Error info:';
//        print_r($_FILES);

        print "</pre>";

        $mysqli->query("INSERT INTO users SET login='".$_POST['name']."', email='".$_POST['email']."', password='".sha1($_POST['password'])."', image='".$new_name."', is_verified=0");
        $mysqli->close();

        $message = " 
        <html> 
            <head> 
                <title> THANK YOU FOR JOINING THREADs </title> 
            </head> 
            <body>
                <img style='margin: auto' src='http://www.images.pajezy.com/notes/thread.png'> 
                <p> TO VERIFY OUR ACCOUNT FOLLOW THE LINK BELLOW </p>
                <p> HERE IS YOUR LINK TO VERIFY OUR ACCOUNT: </p> 
                <a href=\"https://threads/php/verify.php?key=".sha1($_POST['password'])."&login=".$_POST['name']."\"> </a>
                <p> IF YOU DONT KNOW WHAT THE HELL IS GOING ON JUST IGNORE THIS LETTER </p>
            </body> 
        </html>";

        mail(strval($_POST['email']), "Thanks for joining THREADs", $message,
            "From: THREADs \r\n"
            ."X-Mailer: PHP/" . phpversion());

        echo '<script>location.replace("../templates/success.html");</script>'; exit;
}


//
//function image_resize($src, $dst){
//    if(!list($w, $h) = getimagesize($src)) return "Unsupported picture type!";
//    $type = strtolower(substr(strrchr($src,"."),1));
//    if($type == 'jpeg') $type = 'jpg';
//    switch($type){
//        case 'bmp': $img = imagecreatefromwbmp($src); break;
//        case 'gif': $img = imagecreatefromgif($src); break;
//        case 'jpg': $img = imagecreatefromjpeg($src); break;
//        case 'png': $img = imagecreatefrompng($src); break;
//        default : return "Unsupported picture type!";
//    }
//    $x = $y = 0;
//    if($w < $h) { $x = $h/2 - $w/2; $new = imagecreatetruecolor($h, $h); } else { $y = $w/2 - $h/2; $new = imagecreatetruecolor($w, $w); } $color = imagecolorallocate($new, 255, 255, 255); imagefill($new, 0, 0, $color); imagecopyresampled($new, $img, $x, $y, 0, 0, $w, $h, $w, $h); switch($type){ case 'bmp': imagewbmp($new, $dst); break; case 'gif': imagegif($new, $dst); break; case 'jpg': imagejpeg($new, $dst); break; case 'png': imagepng($new, $dst); break; } return true; }


