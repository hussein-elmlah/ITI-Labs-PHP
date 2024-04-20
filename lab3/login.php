<?php

$errors = [];
$old_data = [];
session_start();
// Load user data from users.json file
$usersDataFile = 'database/users_users/users.json';
$users = json_decode(file_get_contents($usersDataFile), true);
$email = $_POST["email"];
$password = $_POST["password"];
var_dump("$email<br>");
var_dump($email);
var_dump("$password<br>");
var_dump($password);
$authenticatedUser = null;
foreach ($users as $user) {
    if ($user['email'] === $email && password_verify($password, $user['password'])) {
        $authenticatedUser = $user;      
        break;
    }
}
if ($authenticatedUser !== null) {
    $_SESSION["user"] = $authenticatedUser;
    // print_r($user);  
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
