<?php

class UserModel {
    public string $username;
    public string $name;
    public string $email;
    public string $phone;
    public array $errors = [];

    public function validate(array $data): bool {
        $this->username = trim($data['username'] ?? '');
        $this->name     = trim($data['name'] ?? '');
        $this->email    = trim($data['email'] ?? '');
        $this->phone    = trim($data['phone'] ?? '');

        if (empty($this->username)) {
            $this->errors['username'] = "Username is required.";
        } elseif (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $this->username)) {
            $this->errors['username'] = "Username must be 3-20 characters (letters, numbers, underscore only).";
        }

        if (empty($this->name)) {
            $this->errors['name'] = "Name is required.";
        } elseif (!preg_match('/^[a-zA-Z\s]{2,50}$/', $this->name)) {
            $this->errors['name'] = "Name must be 2-50 characters (letters only).";
        }

        if (empty($this->email)) {
            $this->errors['email'] = "Email is required.";
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Invalid email format.";
        }

        if (empty($this->phone)) {
            $this->errors['phone'] = "Phone number is required.";
        } elseif (!preg_match('/^[0-9]{10,15}$/', $this->phone)) {
            $this->errors['phone'] = "Phone must be 10-15 digits only.";
        }

        return empty($this->errors);
    }
}
