<?php require '../src/Views/layout/header.php'; ?>

<div class="auth-form">
    <h1>Login</h1>
    
    <?php if (isset($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form action="/login" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" class="button">Login</button>
    </form>

    <p>Don't have an account? <a href="/register">Register here</a></p>
</div>

<?php require '../src/Views/layout/footer.php'; ?>