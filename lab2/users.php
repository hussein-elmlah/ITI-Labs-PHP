<?php

include 'base.php';

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
    <div class="container">
        <h1>User Data</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Country</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Department</th>
                    <th scope="col">Skills</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>';

foreach ($users as $user) {
    echo '<tr>';
    echo '<td>' . $user['id'] . '</td>';
    echo '<td>' . $user['username'] . '</td>';
    echo '<td>' . $user['firstName'] . '</td>';
    echo '<td>' . $user['lastName'] . '</td>';
    echo '<td>' . $user['address'] . '</td>';
    echo '<td>' . $user['country'] . '</td>';
    echo '<td>' . $user['gender'] . '</td>';
    echo '<td>' . $user['department'] . '</td>';
    echo '<td>' . implode(', ', $user['skills']) . '</td>';
    echo '<td><a href="users.php?delete_user=' . $user['id'] . '" class="btn btn-danger btn-sm">Delete</a></td>';
    echo '</tr>';
}

echo '</tbody>
        </table>
    </div>
</body>
</html>';
?>
