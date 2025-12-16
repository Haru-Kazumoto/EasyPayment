<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function auth() {
    return $_SESSION['user'] ?? null;
}

function require_auth() {
    if (!auth()) {
        header('Location: /?page=login');
        exit;
    }
}
