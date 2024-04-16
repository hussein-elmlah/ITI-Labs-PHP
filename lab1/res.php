<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Response</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <?php
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $address = $_POST['address'];
            $country = $_POST['country'];
            $gender = $_POST['gender'];
            $skills = $_POST['skills'];
            $department = $_POST['department'];
        ?>

        <!-- <p><?php print_r($_POST) ?></p> -->

        <h2 class="pt-4">Thanks <?php echo $gender; ?> <?php echo $firstName . ' ' . $lastName; ?></h2>
        <p>Please Review Your Information</p>

        <p><span class="fw-bold">Name:</span> <?php echo $firstName . ' ' . $lastName; ?></p>
        <p><span class="fw-bold">Address:</span> <?php echo $address.','.$country; ?></p>
        <p><span class="fw-bold">Skills:</span></p>
        <?php 
            if (!empty($skills)) {
                foreach ($skills as $skill) {
                    echo "<p class='ps-5'>$skill</p>";
                }
            } else {
                echo "<p>No skills selected</p>";
            }
        ?>
        <p class="pt-3"><span class="fw-bold">Department:</span> <?php echo $department; ?></p>
    </div>
</body>
</html>
