<?php
$config = require 'config/config.php';
$page = $_GET['page'] ?? 'list'; 
$page = trim($page, '/');

if (array_key_exists($page, $config['allowed_url'])) {
    $pageData = $config['allowed_url'][$page];
    $title = $pageData['title'];

    include 'templates/header.php';
    $templatePath = "pages/{$page}_page.php";
    if (file_exists($templatePath)) {
        include $templatePath;
    } else {
        echo "Файл шаблону не знайдено.";
    }

    include 'templates/footer.php';
} else {
    header("HTTP/1.0 404 Not Found");
    include 'templates/header.php';
    echo "<h1>404 - Сторінку не знайдено</h1>";
    include 'templates/footer.php';
}