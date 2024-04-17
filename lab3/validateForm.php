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

if (empty($_POST["firstName"])) {
    $errors["firstName"] = "First name is required";
} else {
    $old_data['firstName'] = $_POST["firstName"];
}

if (empty($_POST["lastName"])) {
    $errors["lastName"] = "Last name is required";
} else {
    $old_data['lastName'] = $_POST["lastName"];
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
    $old_data['password'] = $_POST["password"];
}

if (empty($_POST["address"])) {
    $errors["address"] = "Address is required";
} else {
    $old_data['address'] = $_POST["address"];
}

if (empty($_POST["country"])) {
    $errors["country"] = "Country is required";
} else {
    $old_data['country'] = $_POST["country"];
}

if (empty($_POST["gender"])) {
    $errors["gender"] = "Gender is required";
} else {
    $old_data['gender'] = $_POST["gender"];
}

if (empty($_POST["department"])) {
    $errors["department"] = "Department is required";
} else {
    $old_data['department'] = $_POST["department"];
}

if (!isset($_POST["skills"]) || empty($_POST["skills"])) {
    $errors["skills"] = "Skills are required";
} else {
    $old_data['skills'] = $_POST["skills"];
}

if (count($errors) === 0) {
    $userID = file_get_contents($usersCounterFile);
    file_put_contents($usersCounterFile, $userID + 1);
    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $newUser = [
        'id' => $userID + 1,
        'firstName' => $_POST['firstName'],
        'lastName' => $_POST['lastName'],
        'address' => $_POST['address'],
        'country' => $_POST['country'],
        'gender' => $_POST['gender'],
        'skills' => $_POST['skills'],
        'email' => $_POST['email'],
        'password' => $hashedPassword,
        'department' => $_POST['department']
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
