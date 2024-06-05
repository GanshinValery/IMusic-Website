<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "register-bd";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['cf-name'];
    $email = $_POST['cf-email'];
    $phone = $_POST['cf-phone'];
    $instrument = $_POST['cf-inst'];
    $level = $_POST['cf-level'];
    $referral = $_POST['cf-message'];
    $sql = "INSERT INTO submissions (name, email, phone, instrument, level, referral) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssssss", $name, $email, $phone, $instrument, $level, $referral);
        if ($stmt->execute()) {
            echo "<script>alert('Form submitted successfully!');</script>";
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
    $conn->close();
    header('Location: /');
}
?>
