<?php

class PreferenceController {
    const COOKIE_NAME = 'user_preferences';
    const COOKIE_EXPIRY = 30 * 24 * 60 * 60;

    public string $theme = 'light';
    public array $errors = [];

    public function __construct() {
        $this->loadPreferences();
    }

    private function loadPreferences(): void {
        if (isset($_COOKIE[self::COOKIE_NAME])) {
            $data = json_decode($_COOKIE[self::COOKIE_NAME], true);
            if (is_array($data) && isset($data['theme'])) {
                $this->theme = $data['theme'];
            }
        }
    }

    public function update(array $data): bool {
        $theme = $data['theme'] ?? 'light';

        if (!in_array($theme, ['light', 'dark'])) {
            $this->errors['theme'] = "Invalid theme selection.";
            return false;
        }

        $this->theme = $theme;
        $this->savePreferences();
        return true;
    }

    private function savePreferences(): void {
        setcookie(
            self::COOKIE_NAME,
            json_encode(['theme' => $this->theme]),
            time() + self::COOKIE_EXPIRY,
            '/'
        );
    }

    public function getThemeCSS(): string {
        if ($this->theme === 'dark') {
            return <<<CSS
body {
    background-color: #1a1a1a;
    color: #ffffff;
}
.container, .dashboard-container, .settings-container {
    background-color: #2d2d2d;
    color: #ffffff;
}
input, select {
    background-color: #3d3d3d;
    color: #ffffff;
    border: 1px solid #555;
}
button {
    background-color: #4a90d9;
    color: #ffffff;
}
a {
    color: #6ba3e0;
}
CSS;
        }
        return <<<CSS
body {
    background-color: #f5f5f5;
    color: #333333;
}
.container, .dashboard-container, .settings-container {
    background-color: #ffffff;
    color: #333333;
}
input, select {
    background-color: #ffffff;
    color: #333333;
    border: 1px solid #ccc;
}
button {
    background-color: #007bff;
    color: #ffffff;
}
a {
    color: #007bff;
}
CSS;
    }
}