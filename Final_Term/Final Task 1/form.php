<?php
session_start();
require_once __DIR__ . '/controller/FormController.php';

if (isset($_SESSION['form_result'])) {
    $result = $_SESSION['form_result'];
    unset($_SESSION['form_result']);
} else {
    $result = ['errors' => [], 'data' => [], 'success' => false];
}

require_once __DIR__ . '/view/formView.php';
