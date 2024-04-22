<?php

include 'base.php';
require_once './db/pdo.php';

function validateUser($data, $files, $userId=null)
{
    $errors = [];
    $old_data = [];

    if (empty($data["name"])) {
        $errors["name"] = "First name is required";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/", $data["name"])) {
            $errors["name"] = "Only letters and white space allowed";
        }
        $old_data['name'] = $data["name"];
    }

    if (empty($data["email"])) {
        $errors["email"] = "Email is required";
    } else {
        $old_data['email'] = $data["email"];
        if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Invalid email format";
        } else {
            $pattern="/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
            if (!preg_match($pattern, $data["email"])) {
                $errors["email"] = "Invalid email address";
            } else {
                if (checkEmailExists($data["email"],$userId)) {
                    $errors["email"] = "Email is already taken";
                }
            }
        }
    }


    if (empty($_POST["password"])) {
        $errors["password"] = "Password is required";
    } else {
        $password = $_POST["password"];
        // if (strlen($password) !== 8) {
        //     $errors["password"] = "Password must be at least 8 characters long";
        // } elseif (preg_match('/[^a-z0-9_]/', $password)) {
        //     $errors["password"] = "Password must contain only letters, numbers, and underscores";
        // } elseif (preg_match('/[A-Z]/', $password)) {
        //     $errors["password"] = "Password must not contain capital letters";
        // }
        $old_data['password'] = $password;
    }

    if (empty($_POST["rePassword"])) {
        $errors["rePassword"] = "rePassword is required";
    } else {
        $old_data['rePassword'] = $_POST["rePassword"];
        if ($_POST["password"]!== $_POST["rePassword"]) {
            $errors["rePassword"] = "Passwords do not match";
        }
    }

    if (empty($data["room"])) {
        $errors["room"] = "Room is required";
    } else {
        $old_data['room'] = $data["room"];
    }

    if (empty($data["department"])) {
        $errors["department"] = "Department is required";
    } else {
        $old_data['department'] = $data["department"];
    }

    if (!empty($files['image']['tmp_name'])) {
        $filename = $files['image']['name'];
        $tmp_name = $files['image']['tmp_name'];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
    
        if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'enc'])) {
            $errors["image"] = "Sorry, only JPG, JPEG, PNG , GIF and ENC files are allowed.";
        } else {
            $imagesDirectory = 'images/';
            if (!file_exists($imagesDirectory)) {
                mkdir($imagesDirectory, 0777, true); // Recursive directory creation
            }
    
            // Generate new filename with timestamp before extension
            $timestamp = floor(microtime(true) * 1000);
            $newFilename = pathinfo($filename, PATHINFO_FILENAME) . '-' . $timestamp . '.' . $extension;
            $imagePath = "images/{$newFilename}";
    
            $saved = move_uploaded_file($tmp_name, $imagePath);
            if ($saved) {
                $old_data['image'] = $imagePath;
            } else {
                $errors["image"] = "Failed to upload image.";
            }
        }
    } else {
        // $lastImage = $data['lastImage'];
        // echo "<script>alert('lastImage: |$lastImage|');</script>";
        $old_data['image'] = $data['lastImage'];
    }

    return ['errors' => $errors, 'old_data' => $old_data];
}

?>
