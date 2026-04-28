<?php

class AuthController {
    public string $username;
    public string $email;
    public string $password;
    public array $errors = [];

    public function validate(array $data): bool {
        $this->username = trim($data['username'] ?? '');
        $this->email    = trim($data['email'] ?? '');
        $this->password = trim($data['password'] ?? '');
        $confirmPassword = trim($data['confirm_password'] ?? '');

        if (empty($this->username)) {
            $this->errors['username'] = "Username is required.";
        } elseif (strlen($this->username) < 3) {
            $this->errors['username'] = "Username must be at least 3 characters.";
        }

        if (empty($this->email)) {
            $this->errors['email'] = "Email is required.";
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Invalid email format.";
        }

        if (empty($this->password)) {
            $this->errors['password'] = "Password is required.";
        } elseif (strlen($this->password) < 6) {
            $this->errors['password'] = "Password must be at least 6 characters.";
        }

        if ($this->password !== $confirmPassword) {
            $this->errors['confirm_password'] = "Password and Confirm Password must be same.";
        }

        return empty($this->errors);
    }

    public function validateLogin(array $data): bool {
        $this->username = trim($data['username'] ?? '');
        $this->password = trim($data['password'] ?? '');

        if (empty($this->username)) {
            $this->errors['username'] = "Username is required.";
        }

        if (empty($this->password)) {
            $this->errors['password'] = "Password is required.";
        }

        return empty($this->errors);
    }

    public function authenticate(array $storedUser): bool {
        if ($this->username !== ($storedUser['username'] ?? '') || 
            $this->password !== ($storedUser['password'] ?? '')) {
            $this->errors['login'] = "Invalid username or password.";
            return false;
        }
        return true;
    }

    public function handle(): array {
        $result = [
            'errors'  => [],
            'data'    => [],
            'success' => false
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? 'register';

            if ($action === 'logout') {
                $this->logout();
                header('Location: View/login.php');
                exit;
            } elseif ($action === 'register') {
                $isValid = $this->validate($_POST);

                if ($isValid) {
                    $result['success'] = true;
                    $result['data'] = [
                        'username'  => htmlspecialchars($this->username),
                        'email'     => htmlspecialchars($this->email),
                        'password'  => $this->password,
                        'loginTime' => date('Y-m-d H:i:s')
                    ];
                } else {
                    $result['errors'] = $this->errors;
                    $result['data'] = [
                        'username' => htmlspecialchars($this->username),
                        'email'    => htmlspecialchars($this->email)
                    ];
                }
            } elseif ($action === 'login') {
                $isValid = $this->validateLogin($_POST);

                if ($isValid) {
                    $storedUser = $_SESSION['user'] ?? null;
                    if ($storedUser && $this->authenticate($storedUser)) {
                        $result['success'] = true;
                        $result['data'] = [
                            'username'  => htmlspecialchars($storedUser['username']),
                            'email'     => htmlspecialchars($storedUser['email']),
                            'loginTime' => date('Y-m-d H:i:s')
                        ];
                    } else {
                        $result['errors']['login'] = $this->errors['login'] ?? "Invalid username or password.";
                    }
                } else {
                    $result['errors'] = $this->errors;
                    $result['data'] = [
                        'username' => htmlspecialchars($this->username)
                    ];
                }
            }
        }

        return $result;
    }

    public function logout() {
        session_unset();
        session_destroy();
    }
}