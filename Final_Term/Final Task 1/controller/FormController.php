<?php
require_once __DIR__ . '/../model/UserModel.php';

class FormController {
    private UserModel $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function handle(): array {
        $result = [
            'errors'  => [],
            'data'    => [],
            'success' => false
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $isValid = $this->model->validate($_POST);

            if ($isValid) {
                $result['success'] = true;
                $result['data'] = [
                    'username' => htmlspecialchars($this->model->username),
                    'name'     => htmlspecialchars($this->model->name),
                    'email'    => htmlspecialchars($this->model->email),
                    'phone'    => htmlspecialchars($this->model->phone),
                ];
            } else {
                $result['errors'] = $this->model->errors;
                $result['data']   = [
                    'username' => htmlspecialchars($this->model->username),
                    'name'     => htmlspecialchars($this->model->name),
                    'email'    => htmlspecialchars($this->model->email),
                    'phone'    => htmlspecialchars($this->model->phone),
                ];
            }
        }

        return $result;
    }
}
