<link rel="stylesheet" href="./assets/css/auth-style.css" />


<body>
  <div class="login-box">
    <h2><span style="font-weight: 400">Log in to</span> <em style="font-style: italic;">Tr<span style="color: #A0C4FF;">i</span><span style="color: #BDB2FF;">g</span><span style="color: #E8AEFF;">g</span></em></h2>
        <p>Enter your account to continue !</p>

        <div class="error" id="errorMsg">Invalid username or password.</div>
            <input type="text" id="username" placeholder="Username" />
            <input type="password" id="password" placeholder="Password" />
            <button id="loginBtn">Log In</button>
            
            <a href="main" class="back-link">
                Back to Website
            </a>
        </div>
</body>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="assets/js/auth.js"></script>