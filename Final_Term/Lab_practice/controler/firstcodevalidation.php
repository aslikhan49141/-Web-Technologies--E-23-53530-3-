<?php
session_start();

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$hasusernameErr = false;
$haspasswordErr = false;

if (!$username) {
    $_SESSION["usernameErr"] = "Username is required";
    $hasusernameErr = true;
} else {
    unset($_SESSION["usernameErr"]);
}

if (!$password) {
    $_SESSION["passwordErr"] = "Password is required";
    $haspasswordErr = true;
} else {
    unset($_SESSION["passwordErr"]);
}

if ($hasusernameErr || $haspasswordErr) {
    header("Location: ../iew/firstcode.php");
    
}

echo "<h2>Hi Mr $username</h2>";
echo "<p>Your password is $password</p>";
echo "Congratulations You have  logged in.";
?>

