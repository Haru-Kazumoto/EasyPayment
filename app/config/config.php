<?php
// config.php
// Letakkan file ini di root project atau include di index.php paling atas

// ========================================
// AUTO DETECT BASE URL
// ========================================
function getBaseUrl()
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];

    // Dapatkan path folder dari SCRIPT_NAME
    $scriptPath = dirname($_SERVER['SCRIPT_NAME']);

    // Hilangkan trailing slash jika ada
    $scriptPath = rtrim($scriptPath, '/');

    return $protocol . $host . $scriptPath;
}

define('BASE_URL', getBaseUrl());

// ========================================
// HELPER FUNCTION UNTUK URL
// ========================================

/**
 * Generate URL dengan parameter page
 * @param string $page - Nama halaman
 * @param array $params - Parameter tambahan (optional)
 * @return string
 */
function url($page = '', $params = [])
{
    $url = BASE_URL . '/';

    if (!empty($page)) {
        $params['page'] = $page;
    }

    if (!empty($params)) {
        $url .= '?' . http_build_query($params);
    }

    return $url;
}

/**
 * Generate URL untuk asset (css, js, images)
 * @param string $path - Path ke file asset
 * @return string
 */
function asset($path)
{
    return BASE_URL . '/' . ltrim($path, '/');
}

/**
 * Redirect ke halaman tertentu
 * @param string $page - Nama halaman
 * @param array $params - Parameter tambahan (optional)
 */
function redirect($page = '', $params = [])
{
    header('Location: ' . url($page, $params));
    exit;
}

// ========================================
// CONTOH OUTPUT (untuk testing)
// ========================================
// echo "BASE_URL: " . BASE_URL . "<br>";
// echo "URL Dashboard: " . url('dashboard') . "<br>";
// echo "URL Login: " . url('login') . "<br>";
// echo "Asset CSS: " . asset('assets/css/style.css') . "<br>";
