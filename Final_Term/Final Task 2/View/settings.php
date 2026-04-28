<?php session_start(); ?>
<?php require_once __DIR__ . '/../Controller/PreferenceController.php'; ?>
<?php $prefController = new PreferenceController(); ?>
<?php $themeCSS = $prefController->getThemeCSS(); ?>
<?php $currentTheme = $prefController->theme; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings</title>
    <style>
        <?php echo $themeCSS; ?>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 40px auto; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        select { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        .success { color: green; font-size: 0.85em; margin-top: 10px; padding: 10px; background: rgba(0,255,0,0.1); border-radius: 5px; }
        button { margin-top: 20px; padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
        .links { margin-top: 15px; text-align: center; }
    </style>
</head>
<body>
    <h2>Theme Settings</h2>
    <?php if (isset($_SESSION['preferenceSuccess'])): ?>
        <div class="success"><?= $_SESSION['preferenceSuccess'] ?></div>
        <?php unset($_SESSION['preferenceSuccess']); ?>
    <?php endif; ?>

    <form action="../Controller/validation.php" method="POST">
        <input type="hidden" name="action" value="updatePreferences">

        <label for="theme">Select Theme</label>
        <select id="theme" name="theme">
            <option value="light" <?= $currentTheme === 'light' ? 'selected' : '' ?>>Light</option>
            <option value="dark" <?= $currentTheme === 'dark' ? 'selected' : '' ?>>Dark</option>
        </select>

        <button type="submit">Save Preferences</button>
    </form>
    <div class="links">
        <?php if (isset($_SESSION['user'])): ?>
            <a href="dashboard.php">Dashboard</a> | 
        <?php endif; ?>
        <a href="login.php">Login</a> | 
        <a href="register.php">Register</a>
    </div>
    <p style="text-align: center; font-size: 0.8em; margin-top: 20px;">Preferences stored in cookies for 30 days.</p>
</body>
</html>