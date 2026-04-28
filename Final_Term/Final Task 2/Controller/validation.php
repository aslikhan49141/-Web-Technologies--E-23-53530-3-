<?php
session_start();
require_once __DIR__ . '/../Controller/AuthController.php';
require_once __DIR__ . '/../Controller/PreferenceController.php';

$authController = new AuthController();
$prefController = new PreferenceController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'updatePreferences') {
    $prefController->update($_POST);
    $_SESSION['preferenceSuccess'] = "Preferences saved successfully!";
    header('Location: View/settings.php');
    exit;
}

$result = $authController->handle();

if ($result['success']) {
    $action = $_POST['action'] ?? 'register';
    if ($action === 'register') {
        $_SESSION['user'] = $result['data'];
        header('Location: View/dashboard.php');
    } else {
        $_SESSION['user'] = $result['data'];
        header('Location: View/dashboard.php');
    }
} else {
    $_SESSION['form_result'] = $result;
    $action = $_POST['action'] ?? 'register';
    if ($action === 'login') {
        header('Location: View/login.php');
    } else {
        header('Location: View/register.php');
    }
}
exit;