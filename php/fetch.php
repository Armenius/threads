<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 14.02.2018
 * Time: 17:47
 */

$connect = mysqli_connect("localhost", "root", "", "threads");
$output = '';
if(isset($_POST["query"]))
{
    $search = mysqli_real_escape_string($connect, $_POST["query"]);
    $query = "
              SELECT * FROM users 
              WHERE login LIKE '%".$search."%'
              OR email LIKE '%".$search."%' 
 ";
}
else
{
    $query = "SELECT * FROM users ORDER BY id";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
    $output .= '
            <div class=\"friendsbar\">
                <img src=\"../media/author-min.PNG\" class=\"friends-photo\">
                <p class=\"friends-name\"> '.$data[0][1].' </p>
                <p class=\"last-message\"> Hello, i wanna to tok with u </p>
            </div>
 ';
    while($row = mysqli_fetch_array($result))
    {
        $output .= '
            <div class=\"friendsbar\">
                <img src=\"../media/author-min.PNG\" class=\"friends-photo\">
                <p class=\"friends-name\"> '.$row['login'].' </p>
                <p class=\"last-message\"> Hello, i wanna to tok with u </p>
            </div>
  ';
    }
    echo $output;
}
else
{
    echo 'Data Not Found';
}

?>