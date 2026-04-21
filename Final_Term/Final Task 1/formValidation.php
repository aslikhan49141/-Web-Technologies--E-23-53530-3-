<?php
session_start();
require_once __DIR__ . '/controller/FormController.php';

$controller = new FormController();
$result = $controller->handle();

$_SESSION['form_result'] = $result;
header('Location: form.php');
exit;
