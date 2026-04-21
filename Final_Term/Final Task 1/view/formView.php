<?php?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 40px auto; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        .error { color: red; font-size: 0.85em; margin-top: 3px; }
        .success-box { background: #d4edda; border: 1px solid #28a745; padding: 15px; border-radius: 5px; }
        button { margin-top: 20px; padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <h2>User Registration</h2>

    <?php if ($result['success']): ?>
        <div class="success-box">
            <h3>Submission Successful</h3>
            <p><strong>Username:</strong> <?= $result['data']['username'] ?></p>
            <p><strong>Name:</strong> <?= $result['data']['name'] ?></p>
            <p><strong>Email:</strong> <?= $result['data']['email'] ?></p>
            <p><strong>Phone:</strong> <?= $result['data']['phone'] ?></p>
        </div>
    <?php endif; ?>

    <form action="formValidation.php" method="POST">

        <label for="username">Username</label>
        <input type="text" id="username" name="username"
               value="<?= $result['data']['username'] ?? '' ?>">
        <?php if (!empty($result['errors']['username'])): ?>
            <div class="error"><?= $result['errors']['username'] ?></div>
        <?php endif; ?>

        <label for="name">Name</label>
        <input type="text" id="name" name="name"
               value="<?= $result['data']['name'] ?? '' ?>">
        <?php if (!empty($result['errors']['name'])): ?>
            <div class="error"><?= $result['errors']['name'] ?></div>
        <?php endif; ?>

        <label for="email">Email</label>
        <input type="email" id="email" name="email"
               value="<?= $result['data']['email'] ?? '' ?>">
        <?php if (!empty($result['errors']['email'])): ?>
            <div class="error"><?= $result['errors']['email'] ?></div>
        <?php endif; ?>

        <label for="phone">Phone Number</label>
        <input type="text" id="phone" name="phone"
               value="<?= $result['data']['phone'] ?? '' ?>">
        <?php if (!empty($result['errors']['phone'])): ?>
            <div class="error"><?= $result['errors']['phone'] ?></div>
        <?php endif; ?>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
