<?php
session_start();

$loggedIn = false;

if (isset($_SESSION["user"])) {
  $loggedIn = true;
}

echo "<br><br><br>";

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top z-5">
  <div class="container-fluid">
    <a class="navbar-brand" href="welcome.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php if (!$loggedIn): ?>
          <li class="nav-item">
            <a class="nav-link" href="registrationForm.php">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="loginForm.php">Login</a>
          </li>
        <?php endif; ?>

        <?php if ($loggedIn): ?>
          <li class="nav-item">
            <a class="nav-link" href="users.php">Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
