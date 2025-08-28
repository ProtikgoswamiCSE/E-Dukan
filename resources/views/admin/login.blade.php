
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication System</title>
    <link rel="stylesheet" href="{{ asset('css/admin/admin_login.css') }}">
</head>
<body>
    <div class="container">
        <div class="auth-card">
            <div class="card-header">
                <h1 class="title">Welcome</h1>
                <p class="description" id="description">Sign in to your account to continue</p>
            </div>
            
            <div class="tabs">
                <div class="tab-list">
                    <button class="tab active" data-tab="login">Login</button>
                    <button class="tab" data-tab="register">Register</button>
                </div>
                
                <div class="tab-content">
                    <!-- Login Form -->
                    <div class="tab-panel active" id="login-panel">
                        <form id="login-form">
                            <div class="form-group">
                                <label for="login-email">Email Address</label>
                                <input type="email" id="login-email" placeholder="Enter your email" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="login-password">Password</label>
                                <div class="password-field">
                                    <input type="password" id="login-password" placeholder="Enter your password" required>
                                    <button type="button" class="toggle-password" data-target="login-password">
                                        <span class="eye-icon">👁️</span>
                                    </button>
                                </div>
                            </div>
                            
                            <button type="submit" class="submit-btn" id="login-btn">
                                <span class="btn-text">Sign In</span>
                                <span class="loading hidden">Signing in...</span>
                                <a href="{{ url('admin/dashboard') }}"></a>
                            </button>
                            
                            <div class="forgot-password">
                                <button type="button" class="link-btn">Forgot your password?</button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Register Form -->
                    <div class="tab-panel" id="register-panel">
                        <form id="register-form">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="first-name">First Name</label>
                                    <input type="text" id="first-name" placeholder="John" required>
                                </div>
                                <div class="form-group">
                                    <label for="last-name">Last Name</label>
                                    <input type="text" id="last-name" placeholder="Doe" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="register-email">Email Address</label>
                                <input type="email" id="register-email" placeholder="john.doe@example.com" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="register-password">Password</label>
                                <div class="password-field">
                                    <input type="password" id="register-password" placeholder="Create a strong password" required>
                                    <button type="button" class="toggle-password" data-target="register-password">
                                        <span class="eye-icon">👁️</span>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="confirm-password">Confirm Password</label>
                                <div class="password-field">
                                    <input type="password" id="confirm-password" placeholder="Confirm your password" required>
                                    <button type="button" class="toggle-password" data-target="confirm-password">
                                        <span class="eye-icon">👁️</span>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="checkbox-group">
                                <input type="checkbox" id="accept-terms" required>
                                <label for="accept-terms">
                                    I agree to the <a href="#" class="link">Terms of Service</a> and <a href="#" class="link">Privacy Policy</a>
                                </label>
                            </div>
                            
                            <button type="submit" class="submit-btn" id="register-btn">
                                <span class="btn-text">Create Account</span>
                                <span class="loading hidden">Creating account...</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Toast Notification -->
    <div id="toast" class="toast hidden">
        <div class="toast-content">
            <span id="toast-message"></span>
        </div>
    </div>
    
    <script src="{{ asset('js/admin_login.js') }}"></script>
</body>
</html>
