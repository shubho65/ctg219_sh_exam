<?php
session_start();
include 'connection.php';
$connection = new Connection;

if(isset($_POST['register'])){
	$username=$_POST['username'];
	$password=md5($_POST['password']);

	$array=array(
		":username"=>$username,
		":password"=>$password
	);

	$connection->update("INSERT into users(username,password) VALUES (:username,:password)",$array);
}

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    $array = array(
    ':username'=>$username,
        ':password'=>$password
    );
    $result = $connection->getAll("SELECT * FROM users WHERE username='$username' AND password = '$password'",$array);
    
    if(count($result)){
        $_SESSION['logged_id'] = $username;
        header("location:index.php");
    }
}

?>



<!DOCTYPE html>
<html>
<head>
	<title>Login page</title>
</head>
<body>
<form action="" method="post">
	<label for="username">Username</label>
	<input type="text" name="username" id="username" placeholder="username"><br>
	<label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="password"><br>

    <input type="submit" value="Login" name="login">
        <input type="submit" value="Register" name="register">
	
</form>
<a href="index.php">Home</a>
</body>
</html>