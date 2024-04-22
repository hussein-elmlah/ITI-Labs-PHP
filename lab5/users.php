<?php include 'navbar.php'; ?>

<?php

include 'base.php';
require './db/pdo.php';

// Check if the user is logged in
if (!isset($_SESSION["user"])) {
    header("Location: loginForm.php");
    exit(); // Ensure script execution stops after redirection
}

// Fetch the logged-in user's data from the session
$user = $_SESSION["user"];

// Fetch users from the database using PDO
$users = getUsers();

// Handle user deletion if requested
if (isset($_GET['delete_user'])) {
    $userIdToDelete = $_GET['delete_user'];
    deleteUserById($userIdToDelete);
    header("Location: users.php");
    exit(); // Ensure script execution stops after redirection
}

?>

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
                    <th scope="col">Actions</th> <!-- New column for Actions -->
                </tr>
            </thead>
            <tbody>

            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['room']) ?></td>
                    <td><?= htmlspecialchars($user['department']) ?></td>
                    <td>
                        <?php if ($user['image'] !== null) : ?>
                            <img width="100" height="100" src="<?= htmlspecialchars($user['image']) ?>" />
                        <?php else : ?>
                            No image available
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="updateUserForm.php?id=<?= htmlspecialchars($user['id']) ?>" class="btn btn-primary btn-sm">Edit</a> <!-- Edit button linked to edit_user.php -->
                        <a href="users.php?delete_user=<?= htmlspecialchars($user['id']) ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</body>
</html>
