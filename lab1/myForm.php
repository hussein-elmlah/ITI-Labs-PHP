<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>My Form</h1>
        <form action="res.php" method="POST">
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name:</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name:</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <textarea class="form-control" id="address" name="address" required></textarea>
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Select Country:</label>
                <select class="form-select" id="country" name="country" required>
                    <option value="">Select Country</option>
                    <option value="Egypt">Egypt</option>
                    <option value="USA">USA</option>
                    <option value="UK">UK</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Gender:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="male" name="gender" value="male" required>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="female" name="gender" value="female" required>
                    <label class="form-check-label" for="female">Female</label>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Skills:</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="php" name="skills[]" value="PHP">
                    <label class="form-check-label" for="php">PHP</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="mysql" name="skills[]" value="MySQL">
                    <label class="form-check-label" for="mysql">MySQL</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="java" name="skills[]" value="J2SE">
                    <label class="form-check-label" for="java">J2SE</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="postgres" name="skills[]" value="PostgreSQL">
                    <label class="form-check-label" for="postgres">PostgreSQL</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department:</label>
                <input type="text" class="form-control" id="department" name="department" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </form>
    </div>
</body>
</html>
