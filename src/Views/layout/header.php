<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP MVC App</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <nav>
        <div class="container">
            <a href="/">Home</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/tasks">Tasks</a>
                <a href="/logout">Logout</a>
            <?php else: ?>
                <a href="/login">Login</a>
                <a href="/register">Register</a>
            <?php endif; ?>
        </div>
    </nav>
    <div class="container">