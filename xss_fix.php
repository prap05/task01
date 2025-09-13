<?php
// fixes/xss_fix.php
// Example showing safe output of comments/headlines

function h($s) {
    return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// Example of rendering a comment
$comment_text = $row['comment_text'] ?? '';
header("Content-Security-Policy: default-src 'self'; script-src 'self'; object-src 'none';");
echo '<div class="comment">' . h($comment_text) . '</div>';
?>