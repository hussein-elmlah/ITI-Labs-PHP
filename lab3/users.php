<?php include 'navbar.php'; ?>

<?php

include 'base.php';

session_start();

if (!isset($_SESSION["user"])) {
    header("Location: loginForm.php");
}

$user = $_SESSION["user"];

$usersDataFile = 'database/users_users/users.json';
$users = json_decode(file_get_contents($usersDataFile), true);

if (isset($_GET['delete_user'])) {
    $userIdToDelete = $_GET['delete_user'];
    $userIndex = array_search($userIdToDelete, array_column($users, 'id'));
    if ($userIndex !== false) {
        array_splice($users, $userIndex, 1);
        file_put_contents($usersDataFile, json_encode($users, JSON_PRETTY_PRINT));
        header("Location: users.php");
        exit();
    }
}

echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container fixed-top pt-5 z-0">
        <h1>Users Data</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Room</th>
                    <th scope="col">Department</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>';

foreach ($users as $user) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($user['id']) . '</td>';
    echo '<td>' . htmlspecialchars($user['name']) . '</td>';
    echo '<td>' . htmlspecialchars($user['email']) . '</td>';
    echo '<td>' . htmlspecialchars($user['room']) . '</td>';
    echo '<td>' . htmlspecialchars($user['department']) . '</td>';
    echo '<td> <img width="100" height="100" src="' . htmlspecialchars($user['image']) . '" </td>';
    echo '<td><a href="users.php?delete_user=' . htmlspecialchars($user['id']) . '" class="btn btn-danger btn-sm">Delete</a></td>';
    echo '</tr>';
}

echo '</tbody>
        </table>
    </div>
</body>
</html>';
?>
