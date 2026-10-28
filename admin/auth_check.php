<?php
/**
 * Authentication and Session Guard for Admin Panel
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect to login if unauthenticated
if (empty($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

/**
 * Flash message helpers
 */
function set_flash($type, $message) {
    $_SESSION['flash_msg'] = $message;
    $_SESSION['flash_type'] = $type; // 'success', 'danger', 'info'
}

function display_flash() {
    if (!empty($_SESSION['flash_msg'])) {
        $type = htmlspecialchars($_SESSION['flash_type'] ?? 'info');
        $msg = htmlspecialchars($_SESSION['flash_msg']);
        $icon = $type === 'success' ? 'fa-circle-check' : ($type === 'danger' ? 'fa-triangle-exclamation' : 'fa-circle-info');
        echo "<div class='alert alert-{$type}'>
                <i class='fa-solid {$icon}'></i>
                <span>{$msg}</span>
              </div>";
        unset($_SESSION['flash_msg'], $_SESSION['flash_type']);
    }
}

/**
 * CSRF token helpers
 */
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function get_csrf_token() {
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token) {
    return !empty($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
