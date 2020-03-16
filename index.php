<?php
include("config.php");
session_start();

if (!isset($_COOKIE['username'])) {
    if (isset($_POST['submit'])) {
        $myusername = mysqli_real_escape_string($conn, $_POST['username']);
        $mypassword = mysqli_real_escape_string($conn, $_POST['password']);

        $sql = "SELECT id FROM user WHERE username = '$myusername' and password = '$mypassword'";
        $result = mysqli_query($conn, $sql);
        // if($result === FALSE){
        //     echo("Failed to connect to MYSQL!" . mysqli_error($conn));
        //     exit();
        // }
        // else{
        //     echo("Okay. " . $result);
        // }
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        //$active = $row['id'];

        $count = mysqli_num_rows($result);

        // If result matched $myusername and $mypassword, table row must be 1 row

        if ($count == 1) {
            setcookie('user_id', $row['id']);
            setcookie('username', $myusername);
            $_SESSION['id'] = $row['id'];
            //User to transfer from one page to another
            $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
            header('location: index.php');
        } else {
            $error = "Your username or password is invalid!";
        }
    }
}

if(isset($_GET['pressed'])){
    $_SESSION['question'] = $_GET['pressed'];
    header('location: single.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Engineers Portal - About</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <br>
        <?php include('nav.php'); ?>
        <!-- nav Ends here -->
        <?php
        if (empty($_COOKIE['username'])) {
        ?>
            <div class="row">
                <br>
                <h2 class="text-center">To ask and answer questions, you need to have an account
                    in this website. If you have one, please log into it and if don't have account, please
                    <a href="register.html">Register.</a>
                </h2>
            </div>
            <form method="post" action="">
                <div class="form-group center">
                    <label for="email">Username</label>
                    <input type="text" name="username" class="form-control w-75 ml-5" aria-describedby="emailHelp" placeholder="Enter Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control w-75 ml-5" name="password" placeholder="password">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                <button type="submit" class="btn btn-primary pl-4">Forgot Password?</button>
            </form>
        <?php
        } else {
            echo ('<br><br> <h1 class="login">You are logged in as ' . $_COOKIE['username'] . '.</h1>');
        ?>
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <a href="ask.php">Do you have any question?</a>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <h5>Answer Questions</h5>
            </div>
            <br>
            <?php
            $sql = "SELECT title, questionDetail from question";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);
            
            
            foreach ($row as $r) {
            ?>
                <div class="row">
                    <div class="card">
                        <h5 class="card-header"><?php echo $r.title ?> </h5>
                        <div class="card-body">
                            <p class="card-text"><?php echo $r.questionDetail ?></p>
                            <a href="index.php?pressed=<?php echo $r.title ?>" class="btn btn-primary" >Comment</a>
                        </div>
                    </div>
                </div>
                <br>
            <?php
            }
            echo(" " . $count);
            ?>

        <?php
        }
        ?>
        <br>


        <!--Footer Starts here-->
        <?php include('footer.php'); ?>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>