<?php session_start(); ?>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <h2>Login Form</h2>
        <form method="post" action="../controler/firstcodevalidation.php">
            <table>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username"></td>
                    <td>
                        <p style="color:red;">
                            <?php echo $_SESSION["usernameErr"] ?? ''; ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password"></td>
                    <td>
                        <p style="color:red;">
                            <?php echo $_SESSION["passwordErr"] ?? ''; ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Login"></td>
                </tr>
            </table>
            <?php
            unset($_SESSION["usernameErr"]);
            unset($_SESSION["passwordErr"]);
            ?>
        </form>
    </body>
</html>
