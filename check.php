<?php

function get_db_connection() {
    $mysql = new mysqli('localhost', 'root', 'root','register-bd');
    if ($mysql->connect_error) {
        die("Connection failed: " . $mysql->connect_error);
    }
    return $mysql;
}

$fname = filter_var(trim($_POST ['fname']), FILTER_SANITIZE_STRING);
$lname = filter_var(trim($_POST ['lname']), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST ['email']), FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST ['password']), FILTER_SANITIZE_STRING);

if(mb_strlen($fname) < 1 || mb_strlen($fname) > 90) {
    echo "Invalid length of first name";
    exit();
} else if(mb_strlen($lname) < 1 || mb_strlen($lname) > 90) {
    echo "Invalid length of last name";
    exit();
} else if(mb_strlen($password) < 6 || mb_strlen($password) > 16) {
    echo "Invalid length of password (must be between 6 and 16 characters)";
    exit();
}

$password = md5($password."yodamister52");

$mysql = get_db_connection();

try {
    $stmt = $mysql->prepare("INSERT INTO `users` (`fname`, `lname`, `email`, `password`) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fname, $lname, $email, $password);
    $stmt->execute();
} catch (mysqli_sql_exception $e) {
    if ($e->getCode() == 1062) { // Duplicate entry for email
        echo "Email already exists in the database";
        exit();
    } else {
        echo "Error: " . $e->getMessage();
        exit();
    }
}

$mysql->close();
header('Location: /');

?>
