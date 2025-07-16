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
                <span class="text-1">Step into the realm of forgotten legends</span>
                <span class="text-2">Where myths trade in shadows</span>
            </div>
        </div>
    </div>

        <div class="forms">
            <div class="form-content">

                <!-- Login Form -->
                <div class="login-form">
                    <div class="logo-wrapper">
                        <img src="/assets/img/logo.png" alt="Site Logo" class="logo-img">
                    </div>
                    <div class="title">Login</div>
                    <form action="/handlers/auth.handler.php" method="POST">
                        <input type="hidden" name="action" value="login">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-user"></i>
                                <input type="text" name="username" placeholder="Enter your username" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" placeholder="Enter your password" required>
                            </div>
                            <div class="text">
                                <a href="#">Forgot password?</a>
                            </div>
                            <div class="button input-box">
                                <input type="submit" value="Submit">
                            </div>
                            <div class="text sign-up-text">
                                Don't have an account? <label for="flip"><a href ="/pages/Signup/index.php">Signup now</a></label>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <?php
},
    "Login",
    [
        'css' => [
            '/assets/css/login_signup.css',
        ],
        'js' => []
    ],
    false
);