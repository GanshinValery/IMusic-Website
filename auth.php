<?php
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

$password = md5($password . "yodamister52");

$mysql = new mysqli('localhost', 'root', 'root', 'register-bd');

$result = $mysql->query("SELECT * FROM `users` WHERE `email`= '$email' AND `password` = '$password'");

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    setcookie('user', $user['fname'], time() + 3600, "/");
    $mysql->close();
    header('Location: /');
} else {
    echo "Такой пользователь не найден";
    exit();
}