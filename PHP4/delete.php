<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'task';
    $link = mysqli_connect( $dbhost, $dbuser, $dbpass, $dbname);
    
    $id = $_GET["id"];
    $query = "DELETE FROM emp WHERE id = '$id'";
    if (mysqli_query($link, $query)) {
        header("location: task2.php");
    } else {
         echo "Something went wrong. Please try again later.";
    }
    mysqli_close($link);
?>