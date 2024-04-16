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
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Registration Form</h1>
        <form action="validateForm.php" method="post">
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name:</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo isset($old_data['firstName']) ? $old_data['firstName'] : ''; ?>" required>
                <label style="color: red; font-weight: bold">
                    <?php echo isset($errors['firstName']) ? $errors['firstName'] : ''; ?>
                </label>
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name:</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo isset($old_data['lastName']) ? $old_data['lastName'] : ''; ?>" required>
                <label style="color: red; font-weight: bold">
                    <?php echo isset($errors['lastName']) ? $errors['lastName'] : ''; ?>
                </label>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($old_data['username']) ? $old_data['username'] : ''; ?>" required>
                <label style="color: red; font-weight: bold">
                    <?php echo isset($errors['username']) ? $errors['username'] : ''; ?>
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
                <label for="address" class="form-label">Address:</label>
                <textarea class="form-control" id="address" name="address" required><?php echo isset($old_data['address']) ? $old_data['address'] : ''; ?></textarea>
                <label style="color: red; font-weight: bold">
                    <?php echo isset($errors['address']) ? $errors['address'] : ''; ?>
                </label>
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Select Country:</label>
                <select class="form-select" id="country" name="country" required>
                    <option value="">Select Country</option>
                    <option value="Egypt" <?php echo isset($old_data['country']) && $old_data['country'] === 'Egypt' ? 'selected' : ''; ?>>Egypt</option>
                    <option value="USA" <?php echo isset($old_data['country']) && $old_data['country'] === 'USA' ? 'selected' : ''; ?>>USA</option>
                    <option value="UK" <?php echo isset($old_data['country']) && $old_data['country'] === 'UK' ? 'selected' : ''; ?>>UK</option>
                </select>
                <label style="color: red; font-weight: bold">
                    <?php echo isset($errors['country']) ? $errors['country'] : ''; ?>
                </label>
            </div>
            <div class="mb-3">
                <label class="form-label">Gender:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="male" name="gender" value="male" <?php echo isset($old_data['gender']) && $old_data['gender'] === 'male' ? 'checked' : ''; ?> required>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="female" name="gender" value="female" <?php echo isset($old_data['gender']) && $old_data['gender'] === 'female' ? 'checked' : ''; ?> required>
                    <label class="form-check-label" for="female">Female</label>
                </div>
                <label style="color: red; font-weight: bold">
                    <?php echo isset($errors['gender']) ? $errors['gender'] : ''; ?>
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
                <label class="form-label">Skills:</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="php" name="skills[]" value="PHP" <?php echo isset($old_data['skills']) && in_array('PHP', $old_data['skills']) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="php">PHP</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="mysql" name="skills[]" value="MySQL" <?php echo isset($old_data['skills']) && in_array('MySQL', $old_data['skills']) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="mysql">MySQL</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="java" name="skills[]" value="J2SE" <?php echo isset($old_data['skills']) && in_array('J2SE', $old_data['skills']) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="java">J2SE</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="postgres" name="skills[]" value="PostgreSQL" <?php echo isset($old_data['skills']) && in_array('PostgreSQL', $old_data['skills']) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="postgres">PostgreSQL</label>
                </div>
                <label style="color: red; font-weight: bold">
                    <?php echo isset($errors['skills']) ? $errors['skills'] : ''; ?>
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </form>
    </div>
</body>
</html>