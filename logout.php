<?php 
    setcookie('username', 'id', time() - 60*60);
    ?>
    <h2> <a href="index.php"> Please Click here to go to home page.</a> </h2>
    <php
    if(empty($_COOKIE['username'])){
        header("location: index.php");
    }
?>