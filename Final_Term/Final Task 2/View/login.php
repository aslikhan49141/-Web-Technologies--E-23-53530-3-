<?php session_start(); ?>
<?php $result = $_SESSION['form_result'] ?? ['errors' => [], 'data' => []]; ?>
<?php require_once __DIR__ . '/Controller/PreferenceController.php'; ?>
<?php $prefController = new PreferenceController(); ?>
<?php $themeCSS = $prefController->getThemeCSS(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        <?php echo $themeCSS; ?>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 40px auto; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        .error { color: red; font-size: 0.85em; margin-top: 3px; }
        button { margin-top: 20px; padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
        .links { margin-top: 15px; text-align: center; }
    </style>
</head>
<body>
    <h2>Login</h2>
    <?php if (!empty($result['errors']['login'])): ?>
        <div class="error"><?= $result['errors']['login'] ?></div>
    <?php endif; ?>
    
    <form action="../Controller/validation.php" method="POST">
        <input type="hidden" name="action" value="login">

        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?= $result['data']['username'] ?? '' ?>">
        <?php if (!empty($result['errors']['username'])): ?>
            <div class="error"><?= $result['errors']['username'] ?></div>
        <?php endif; ?>

        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        <?php if (!empty($result['errors']['password'])): ?>
            <div class="error"><?= $result['errors']['password'] ?></div>
        <?php endif; ?>

        <button type="submit">Login</button>
    </form>
    <div class="links">
        <p>Don't have an account? <a href="register.php">Register here</a></p>
        <p><a href="settings.php">Theme Settings</a></p>
    </div>
    <?php unset($_SESSION['form_result']); ?>
</body>
</html>