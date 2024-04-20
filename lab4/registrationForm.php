<?php

    include 'base.php';

    if(isset($_GET['errors'])){
        $errors = json_decode($_GET["errors"], true);
    }

    if(isset($_GET['old_data'])){
        $old_data = json_decode($_GET["old_data"], true);
    }

    // session_start();

    if (isset($_SESSION["user"])) {
        header("Location: welcome.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?> 
    <div class="container">
        <!-- <h1>Registration Form</h1> -->
        <form action="register.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($old_data['name']) ? $old_data['name'] : ''; ?>" required>
                <label style="color: red; font-weight: bold">
                    <?php echo isset($errors['name']) ? $errors['name'] : ''; ?>
                </label>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($old_data['email']) ? $old_data['email'] : ''; ?>" required>
                <label style="color: red; font-weight: bold">
                    <?php echo isset($errors['email']) ? $errors['email'] : ''; ?>
                </label>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <label style="color: red; font-weight: bold">
                    <?php echo isset($errors['password']) ? $errors['password'] : ''; ?>
                </label>
            </div>
            <div class="mb-3">
                <label for="rePassword" class="form-label">rePassword:</label>
                <input type="password" class="form-control" id="rePassword" name="rePassword" required>
                <label style="color: red; font-weight: bold">
                    <?php echo isset($errors['rePassword']) ? $errors['rePassword'] : ''; ?>
                </label>
            </div>
            <div class="mb-3">
                <label for="room" class="form-label">Select Room:</label>
                <select class="form-select" id="room" name="room" required>
                    <option value="">Select room</option>
                    <option value="Application1" <?php echo isset($old_data['room']) && $old_data['room'] === 'Application1' ? 'selected' : ''; ?>>Application1</option>
                    <option value="Application2" <?php echo isset($old_data['room']) && $old_data['room'] === 'Application2' ? 'selected' : ''; ?>>Application2</option>
                    <option value="Cloud" <?php echo isset($old_data['room']) && $old_data['room'] === 'Cloud' ? 'selected' : ''; ?>>Cloud</option>
                </select>
                <label style="color: red; font-weight: bold">
                    <?php echo isset($errors['room']) ? $errors['room'] : ''; ?>
                </label>
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department:</label>
                <input type="text" class="form-control" id="department" name="department" value="<?php echo isset($old_data['department']) ? $old_data['department'] : ''; ?>" required>
                <label style="color: red; font-weight: bold">
                    <?php echo isset($errors['department']) ? $errors['department'] : ''; ?>
                </label>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Profile picture</label>
                <input type="file" name="image"
                class="form-control"  aria-describedby="emailHelp">
                <label style="color: red; font-weight: bold">
                        <?php echo isset($errors['image']) ? htmlspecialchars($errors['image']) : ''; ?>
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </form>
    </div>
</body>
</html>