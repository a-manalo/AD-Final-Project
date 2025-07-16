<?php
    declare(strict_types=1);

    require_once BASE_PATH . '/vendor/autoload.php';
    require_once UTILS_PATH . '/auth.util.php';
    Auth::init();
    require_once LAYOUTS_PATH . "/main.layout.php";

renderMainLayout(function () {
    ?>

    <div class="container">
        <input type="checkbox" id="flip">
        <div class="cover">
        <div class="front">
            <img src="/assets/img/Background.jpg" alt="Mystic Background">
            <div class="text">
                <span class="text-1">Unlock the secrets of the unseen</span>
                <span class="text-2">Only the chosen may proceed</span>
            </div>
        </div>
    </div>

    <div class="forms">
        <div class="form-content">
            <!-- Signup Form -->
            <div class="signup-form">
                <div class="logo-wrapper">
                    <img src="/assets/img/logo.png" alt="Site Logo" class="logo-img">
                </div>
                <div class="title">Signup</div>
                <form action="/handlers/signup.handler.php" method="POST">
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
                            Already have an account? <label for="flip"><a href ="/pages/Login/index.php">Login now</a></label>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
    <?php
},
    "Signup",
    [
        'css' => [
            '/assets/css/login_signup.css',
        ],
        'js' => []
    ],
    false
);