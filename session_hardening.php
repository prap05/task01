<?php
// fixes/session_hardening.php
// Apply secure session cookie settings at runtime (or set them in php.ini)
ini_set('session.cookie_httponly', 1);
// Set session.cookie_secure = 1 when using HTTPS
ini_set('session.cookie_secure', 0);
ini_set('session.cookie_samesite', 'Strict');

session_start();

// Example: regenerate id on privilege change
// session_regenerate_id(true);
?>