<?php
// fixes/sql_fix.php
// Example PDO-based login check with password hashing and session regeneration
session_start();

// Set secure cookie params (if using HTTPS)
session_set_cookie_params(['httponly' => true, 'secure' => false, 'samesite' => 'Strict']); // set secure=>true on HTTPS

require 'db_connection.php'; // assume this file sets up $pdo as PDO instance

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Prepared statement prevents SQL Injection
$stmt = $pdo->prepare('SELECT id, password_hash FROM users WHERE username = :username');
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password_hash'])) {
    // Regenerate session id on login to prevent fixation
    session_regenerate_id(true);
    $_SESSION['user_id'] = $user['id'];
    echo "Login successful";
} else {
    echo "Invalid credentials";
}
?>