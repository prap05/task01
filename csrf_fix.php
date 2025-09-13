<?php
// fixes/csrf_fix.php
session_start();

// generate token once per session
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Include in form as hidden field
// <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />

// Validate on POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
        http_response_code(403);
        die('Invalid CSRF token');
    }
    // process the action
}
?>