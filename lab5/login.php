<?php

include 'base.php';
require_once './db/pdo.php';

$errors = [];
$old_data = [];

session_start();

$email = $_POST["email"];
$password = $_POST["password"];

$authenticatedUser = null;

$users = getUsers();

foreach ($users as $user) {
    if ($user['email'] === $email && password_verify($password, $user['password'])) {
        echo "<script>alert('user: |$$user|');</script>";
        // Extracting password from the user array
        $password = $user['password'];
        // Creating a new array without the password field
        $authenticatedUser = $user;
        unset($authenticatedUser['password']);

        break;
    }
}

if ($authenticatedUser !== null) {
    $_SESSION["user"] = $authenticatedUser;
    header("Location: welcome.php");
    exit();
} else {
    $errors["login"] = "Invalid email or password";
    $old_data['email'] = $_POST["email"];
    $old_data['password'] = $_POST["password"];
    $errors = json_encode($errors);
    $old_data = json_encode($old_data);
    $url = "errors={$errors}&old_data={$old_data}";
    header("Location: loginForm.php?{$url}");
    exit();
}

?>
