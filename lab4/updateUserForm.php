<?php include 'navbar.php'; ?>

<?php

include 'base.php';
require './db/pdo.php';
require 'validateUser.php';

// session_start();

if (!isset($_SESSION["user"])) {
    header("Location: loginForm.php");
}

$errors = [];
$old_data = [];

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $userId = $_GET['id'];
    $user = getUserById($userId);
    if (!$user) {
        header("Location: users.php");
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = (int)$_GET['id'];
    // var_dump($userId);
    $validationResult = validateUser($_POST, $_FILES, $userId);
    $errors = $validationResult['errors'];
    $old_data = $validationResult['old_data'];

    // var_dump("Current file path:", __FILE__);
    // var_dump("Errors:", $errors);
    // var_dump("Old Data:", $old_data);

    if (count($errors) === 0) {
        $updated = updateUserById($userId, $_POST['name'], $_POST['email'], $_POST['password'], $_POST['room'], $_POST['department'], $old_data['image']);
        if ($updated) {
            header("Location: users.php");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container pt-5">
        <h1 class="pt-3">Edit User</h1>
        <form action="updateUserForm.php?id=<?= $userId ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= isset($old_data['name']) ? $old_data['name'] : $user['name'] ?>" required>
                <label style="color: red; font-weight: bold"><?= isset($errors['name']) ? $errors['name'] : ''; ?></label>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= isset($old_data['email']) ? $old_data['email'] : $user['email'] ?>" required>
                <label style="color: red; font-weight: bold"><?= isset($errors['email']) ? $errors['email'] : ''; ?></label>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <label style="color: red; font-weight: bold"><?= isset($errors['password']) ? $errors['password'] : ''; ?></label>
            </div>
            <div class="mb-3">
                <label for="rePassword" class="form-label">Re-enter Password:</label>
                <input type="password" class="form-control" id="rePassword" name="rePassword" required>
                <label style="color: red; font-weight: bold"><?= isset($errors['rePassword']) ? $errors['rePassword'] : ''; ?></label>
            </div>
            <div class="mb-3">
                <label for="room" class="form-label">Select Room:</label>
                <select class="form-select" id="room" name="room" required>
                    <option value="">Select room</option>
                    <option value="Application1" <?= (isset($old_data['room']) && $old_data['room'] === 'Application1') || $user['room'] === 'Application1' ? 'selected' : ''; ?>>Application1</option>
                    <option value="Application2" <?= (isset($old_data['room']) && $old_data['room'] === 'Application2') || $user['room'] === 'Application2' ? 'selected' : ''; ?>>Application2</option>
                    <option value="Cloud" <?= (isset($old_data['room']) && $old_data['room'] === 'Cloud') || $user['room'] === 'Cloud' ? 'selected' : ''; ?>>Cloud</option>
                </select>
                <label style="color: red; font-weight: bold"><?= isset($errors['room']) ? $errors['room'] : ''; ?></label>
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department:</label>
                <input type="text" class="form-control" id="department" name="department" value="<?= isset($old_data['department']) ? $old_data['department'] : $user['department'] ?>" required>
                <label style="color: red; font-weight: bold"><?= isset($errors['department']) ? $errors['department'] : ''; ?></label>
            </div>
            <div class="row mb-1">
                <label for="image" class="form-label col-12">Profile Picture:</label>
                <div class="form-label col-3">
                    <label for="imageUpload" style="cursor: pointer;">
                        <img id="imagePreview" class="rounded" width='150' height='150' src="<?= isset($old_data['image']) ? $old_data['image'] : $user['image'] ?>">
                    </label>
                </div>
                <input type="file" id="imageUpload" class="form-control d-none" id="image" name="image" onchange="previewImage(this)">
                <label style="color: red; font-weight: bold"><?= isset($errors['image']) ? $errors['image'] : ''; ?></label>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const file = input.files[0];
            const reader = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
            }
        }
    </script>

</body>
</html>
