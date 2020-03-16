<?php
    include('config.php');
    session_start();

    $user_check = $_COOKIE['username'];

    if(!isset($_COOKIE['username'])){
        header("location: index.php");
        die();
    }
?>