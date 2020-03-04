<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $table = "users";

    $conn = mysqli_connect($servername, $username, $password, $table);

    // if(!$conn){
    //     die("Connection Failed: " . mysqli_connect_error());
    // }

    $user= $_POST["username"];
    $pass= $_POST["password"];
    $name= $_POST["name"];
    $email= $_POST["email"];
    $phone= $_POST["phone"];

    $sql = "INSERT INTO user (username, password, name, email, phone) 
    VALUES($user, $pass, $name, $email, $phone )";
    
    if(mysqli_query($conn, $sql)){
        echo "Registered successfully! Go back and log in!";
    }
    else {
        echo "Error: Not done!". $sql . "<br>" . mysqli_error($conn);
    }

    // $email = $_POST["email"];
    // echo "Connected Successfully ". $email;

?>