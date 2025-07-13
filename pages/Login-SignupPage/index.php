<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login & Sign Up</title>
    <link rel="stylesheet" href="/pages/Login-SignupPage/assets/css/login-signup.css">
</head>
<body>

<!-- Flash Messages -->
<?php if (isset($_SESSION['success'])): ?>
    <div class="success">
        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php elseif (isset($_SESSION['error'])): ?>
    <div class="error">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
    <div class="front">
        <img src="/assets/img/Background.jpg" alt="Mystic Background">
        <div class="text">
            <span class="text-1">Step into the realm of forgotten legends</span>
            <span class="text-2">Where myths trade in shadows</span>
        </div>
    </div>
    <div class="back">
        <img class="backImg" src="/assets/img/Background.jpg" alt="Mystic Background">
        <div class="text">
            <span class="text-1">Unlock the secrets of the unseen</span>
            <span class="text-2">Only the chosen may proceed</span>
        </div>
    </div>
</div>


    <div class="forms">
        <div class="form-content">

            <!-- Login Form -->
            <div class="login-form">
                <div class="logo-wrapper">
                    <img src="/pages/Login-SignupPage/assets/img/Heading-Photoroom.png" alt="Site Logo" class="logo-img">
                </div>
                <div class="title">Login</div>
                <form action="/handlers/login-testing.handler.php" method="POST">
                    <input type="hidden" name="action" value="login">
                    <div class="input-boxes">
                        <div class="input-box">
                            <i class="fas fa-user"></i>
                            <input type="text" name="username" placeholder="Enter your username" required>
                        </div>
                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="pswd" placeholder="Enter your password" required>
                        </div>
                        <div class="text">
                            <a href="#">Forgot password?</a>
                        </div>
                        <div class="button input-box">
                            <input type="submit" value="Submit">
                        </div>
                        <div class="text sign-up-text">
                            Don't have an account? <label for="flip">Signup now</label>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Signup Form -->
            <div class="signup-form">
                <div class="logo-wrapper">
                    <img src="/pages/Login-SignupPage/assets/img/Heading-Photoroom.png" alt="Site Logo" class="logo-img">
                </div>
                <div class="title">Signup</div>
                <form action="/handlers/login-testing.handler.php" method="POST">
                    <input type="hidden" name="action" value="signup">
                    <div class="input-boxes">
                        <div class="input-box">
                            <i class="fas fa-user"></i>
                            <input type="text" name="username" placeholder="Create a username" required>
                        </div>
                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="pswd" placeholder="Create a password" required>
                        </div>
                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="confirm_pswd" placeholder="Confirm password" required>
                        </div>
                        <div class="button input-box">
                            <input type="submit" value="Submit">
                        </div>
                        <div class="text sign-up-text">
                            Already have an account? <label for="flip">Login now</label>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

</body>
</html>
