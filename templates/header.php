<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Belmort'; ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<header>
    <nav class="navbar">
        <ul class="nav-links">
            <li>
                <a href="/list" class="<?php echo ($page === 'list') ? 'active' : ''; ?>">
                    Список лідів
                </a>
            </li>
            <li>
                <a href="/form" class="<?php echo ($page === 'form') ? 'active' : ''; ?>">
                    Додати ліда
                </a>
            </li>
        </ul>
    </nav>
</header>

<div class="container">