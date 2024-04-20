<?php

include 'base.php';

echo "Form Validation <br>";
echo "Running ...<br>";

$usersDataDirectory = 'database/users_users/';
if (!file_exists($usersDataDirectory)) {
    mkdir($usersDataDirectory, 0777, true); // Recursive directory creation
}
$usersDataFile = $usersDataDirectory . 'users.json';
$usersCounterFile = $usersDataDirectory . 'users_counter.json';
if (!file_exists($usersDataFile)) {
    file_put_contents($usersDataFile, '[]');
}
if (!file_exists($usersCounterFile)) {
    file_put_contents($usersCounterFile, '0');
}

$users = json_decode(file_get_contents($usersDataFile), true);
if (empty($users)) {
    $users = [];
}

$errors = [];
$old_data = [];

if (empty($_POST["name"])) {
    $errors["name"] = "First name is required";
} else {
    if (!preg_match("/^[a-zA-Z ]*$/", $_POST["name"])) {
        $errors["name"] = "Only letters and white space allowed";
    }
    $old_data['name'] = $_POST["name"];
}

if (empty($_POST["email"])) {
    $errors["email"] = "Email is required";
} else {
    $old_data['email'] = $_POST["email"];
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format";
    } else {
        $pattern="/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
        if (!preg_match($pattern, $_POST["email"])) {
            $errors["email"] = "Invalid email address";
        } else {
            foreach ($users as $user) {
                if ($user['email'] === $_POST["email"]) {
                    $errors["email"] = "Email is already taken";
                    break;
                }
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

if (empty($_POST["room"])) {
    $errors["room"] = "room is required";
} else {
    $old_data['room'] = $_POST["room"];
}

if (empty($_POST["department"])) {
    $errors["department"] = "Department is required";
} else {
    $old_data['department'] = $_POST["department"];
}

if (!empty($_FILES['image']['tmp_name'])) {
    $filename = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
        $errors["image"] = "Sorry, only JPG, JPEG, PNG and GIF files are allowed.";
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
            echo "<img  width='300' height='300' src='{$imagePath}'> ";
        } else {
            $errors["image"] = "Failed to upload image.";
        }
    }
}

if (count($errors) === 0) {
    $userID = file_get_contents($usersCounterFile);
    file_put_contents($usersCounterFile, $userID + 1);
    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $newUser = [
        'id' => $userID + 1,
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $hashedPassword,
        'room' => $_POST['room'],
        'department' => $_POST['department'],
        'image' => $imagePath,
    ];
    array_push($users, $newUser);
    file_put_contents($usersDataFile, json_encode($users, JSON_PRETTY_PRINT));
    header("Location: users.php");
} else {
    // Redirect back to registration form with error messages
    $errors = json_encode($errors);
    $old_data = json_encode($old_data);
    $url = "errors={$errors}&old_data={$old_data}";
    header("Location: registrationForm.php?{$url}");
}
?>
