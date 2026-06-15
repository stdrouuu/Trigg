<?php
// Public login page
?>
<link rel="stylesheet" href="./assets/css/auth-style.css" />
<div class="login-box">
    <h2>Log in</h2>
    <p>Enter your account to continue</p>
    <div class="error" id="errorMsg"></div>
    <input type="text" id="username" placeholder="Username" />
    <input type="password" id="password" placeholder="Password" />
    <button id="loginBtn">Log In</button>
    <a href="main" class="back-link"><i class="fas fa-arrow-left"></i> Back to Website</a>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="assets/js/auth.js"></script>