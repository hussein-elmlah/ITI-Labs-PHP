<?php

include 'base.php';
require_once 'config.php';

function createUsersTable()
{
    global $pdo;

    try {
        $pdo->exec("CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            room VARCHAR(255) NOT NULL,
            department VARCHAR(255) NOT NULL,
            image VARCHAR(255) NOT NULL
        )");
    } catch (PDOException $e) {
        die("Error creating users table: " . $e->getMessage());
    }
}


function checkEmailExists($email, $userId = null)
{
    global $pdo;

    $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
    $params = [$email];

    if ($userId !== null) {
        $sql .= " AND id != ?";
        $params[] = $userId;
        // echo "<script>alert('userId with ID: |$userId|');</script>";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchColumn();
}

function addUser($name, $email, $password, $room, $department, $imagePath)
{
    global $pdo;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if (checkEmailExists($email)) {
        return false;
    }
    
    if ($imagePath == '') {
        $imagePath = "https://www.pngplay.com/wp-content/uploads/12/User-Avatar-Profile-PNG-Free-File-Download.png";
    }

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, room, department, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $hashedPassword, $room, $department, $imagePath]);
    return true;
}

function getUsers()
{
    global $pdo;

    $stmt = $pdo->query("SELECT * FROM users");
    return $stmt->fetchAll();
}

function deleteUserById($userId)
{
    global $pdo;

    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$userId]);
}

function getUserById($userId)
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $user ? $user : null;
}

function updateUserById($userId, $name, $email, $password, $room, $department, $imagePath)
{
    global $pdo;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Displaying imagePath for debugging
    echo "<script>alert('imagePath: |$imagePath|');</script>";

    try {
        if ($imagePath == '') {
            $stmt = $pdo->prepare("UPDATE users SET name =?, email =?, password =?, room =?, department =? WHERE id =?");
            $stmt->execute([$name, $email, $hashedPassword, $room, $department, $userId]);
        } else {
            $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ?, password = ?, room = ?, department = ?, image = ? WHERE id = ?");
            $stmt->execute([$name, $email, $hashedPassword, $room, $department, $imagePath, $userId]);
        }
        // Return true if the update was successful
        return true;
    } catch (PDOException $e) {
        // If an exception occurs, return false
        return false;
    }
}

// Create the users table if it doesn't exist
createUsersTable();

?>
