<?php session_start(); ?>
<?php require_once __DIR__ . '/Controller/PreferenceController.php'; ?>
<?php $prefController = new PreferenceController(); ?>
<?php $themeCSS = $prefController->getThemeCSS(); ?>
<?php $user = $_SESSION['user'] ?? null; ?>
<?php if (!$user): ?>
<?php header('Location: login.php'); exit; ?>
<?php endif; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        <?php echo $themeCSS; ?>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 40px auto; }
        .user-info { background: rgba(0,0,0,0.05); padding: 15px; border-radius: 5px; margin: 20px 0; }
        .user-info p { margin: 10px 0; }
        .user-info strong { display: inline-block; width: 100px; }
        button { margin-top: 20px; padding: 10px 20px; background: #dc3545; color: white; border: none; cursor: pointer; }
        button:hover { background: #c82333; }
        .links { margin-top: 15px; text-align: center; }
    </style>
</head>
<body>
    <h2>Dashboard</h2>
    <div class="user-info">
        <p><strong>Welcome,</strong> <?= htmlspecialchars($user['username']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
        <p><strong>Login Time:</strong> <?= htmlspecialchars($user['loginTime']) ?></p>
    </div>
    <div class="links">
        <a href="settings.php">Theme Settings</a>
    </div>
    <form action="../Controller/validation.php" method="POST" style="display:inline;">
        <input type="hidden" name="action" value="logout">
        <button type="submit">Logout</button>
    </form>
</body>
</html>