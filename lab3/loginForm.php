<?php
    if(isset($_GET['errors'])){
        $errors = json_decode($_GET["errors"], true);
    }

    if(isset($_GET['old_data'])){
        $old_data = json_decode($_GET["old_data"], true);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?> 
    <div class="container">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($old_data['email']) ? $old_data['email'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo isset($old_data['password']) ? $old_data['password'] : ''; ?>" required>
                <label style="color: red; font-weight: bold">
                    <?php echo isset($errors['login']) ? $errors['login'] : ''; ?>
                </label>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>
