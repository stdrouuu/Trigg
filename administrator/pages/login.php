<script>"Admin Login | Trigg";</script>
<link href="assets/css/admin-login.css" rel="stylesheet" />

<div class="login-box">
    <div class="admin-icon">
        <i class="fas fa-user-shield"></i>
    </div>
    <h2>Admin Login</h2>
    <p class="subtitle">Enter your admin credentials to continue</p>

    <div class="error-msg" id="errorMsg">Invalid username or password.</div>

    <input type="text" id="adminUsername" placeholder="Username" />
    <input type="password" id="adminPassword" placeholder="Password" />
    <button id="adminLoginBtn">Log In</button>

    <a href="main" class="back-link">
        <i class="fas fa-arrow-left"></i> Back to Website
    </a>
</div>

<script src="assets/js/admin-login.js"></script>
