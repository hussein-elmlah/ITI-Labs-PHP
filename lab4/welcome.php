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
    <div class="bg-dark">
        <div class="container">
            <div class="container px-4 py-5 row" height='250'>
                <div class="col-3">
                    <img id="imagePreview" class="rounded" width='200' height='200' src="<?php echo htmlspecialchars($user["image"]); ?>" alt="user image">
                </div>
                <div class="col-9">
                    <h1 class="pt-5 text-white">Welcome, <?php echo htmlspecialchars($user["name"]); ?>!</h1>
                    <p class="text-white">You have successfully logged in.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-body-secondary min-vh-100  pt-5">
        <div class="container pt-5">
            <table class="table">
                <tbody class="border border-2 border-dark ">
                    <tr>
                        <th scope="row">Department:</th>
                        <td><?php echo htmlspecialchars($user["department"]); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Email:</th>
                        <td><?php echo htmlspecialchars($user["email"]); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Room:</th>
                        <td><?php echo htmlspecialchars($user["room"]); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
