<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: loginForm.php");
}

$user = $_SESSION["user"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?> 
    <div class="container pt-5">
        <h1 class="pt-5">Welcome, <?php echo htmlspecialchars($user["name"]); ?>!</h1>
        <p>You have successfully logged in.</p>
    </div>
</body>
</html>
