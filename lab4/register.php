<?php

include 'base.php';
require './db/pdo.php';
require 'validateUser.php';

$errors = [];
$old_data = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validationResult = validateUser($_POST,$_FILES);
    $errors = $validationResult['errors'];
    $old_data = $validationResult['old_data'];

    if (count($errors) === 0) {
        $added = addUser($_POST['name'], $_POST['email'], $_POST['password'], $_POST['room'], $_POST['department'], $old_data['image']);
        if ($added) {
            header("Location: users.php");
            exit();
        } else {
            $errors["email"] = "Email is already taken";
        }
    } else {
        $errors = json_encode($errors);
        $old_data = json_encode($old_data);
        $url = "errors={$errors}&old_data={$old_data}";
        header("Location: registrationForm.php?{$url}");
        exit();
    }
}

?>
