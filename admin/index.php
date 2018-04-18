<?php
include "../includes/dbconfig.php";
include "../includes/db.php";

session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
        echo $error;
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $db = new Db();
        $result = $db->query("SELECT * FROM users WHERE password='$password' AND username='$username'");
        if ($result) {
            header("location: welcome.php");
        } else {
            $error = "No such user";
            echo $error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog admin panel</title>
    <link rel="shortcut icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<div class="container">

    <form class="form-signin">
        <h2 class="form-signin-heading">Admin panel</h2>
        <label for="user" class="sr-only">Username</label>
        <input type="text" id="user" class="form-control" name="username" placeholder="Username" autofocus>
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" class="form-control" name="password" placeholder="Password">
        <button class="btn btn-lg btn-primary btn-block" type="submit" formmethod="post">Sign in</button>
    </form>

</div>

<script src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
</html>