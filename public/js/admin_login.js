// DOM Elements
const tabs = document.querySelectorAll('.tab');
const tabPanels = document.querySelectorAll('.tab-panel');
const description = document.getElementById('description');
const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');
const toast = document.getElementById('toast');
const toastMessage = document.getElementById('toast-message');

// Tab switching functionality
tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        const tabName = tab.dataset.tab;
        
        // Update active tab
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        
        // Update active panel
        tabPanels.forEach(panel => panel.classList.remove('active'));
        document.getElementById(`${tabName}-panel`).classList.add('active');
        
        // Update description
        if (tabName === 'login') {
            description.textContent = 'Sign in to your account to continue';
        } else {
            description.textContent = 'Create a new account to get started';
        }
    });
});
document.getElementById('login-btn').addEventListener('click', function() {
        window.location.href = '/admin/dashboard';
    });

// Password visibility toggle
document.querySelectorAll('.toggle-password').forEach(button => {
    button.addEventListener('click', () => {
        const targetId = button.dataset.target;
        const input = document.getElementById(targetId);
        const eyeIcon = button.querySelector('.eye-icon');
        
        if (input.type === 'password') {
            input.type = 'text';
            eyeIcon.textContent = '🙈';
        } else {
            input.type = 'password';
            eyeIcon.textContent = '👁️';
        }
    });
});

// Toast notification function
function showToast(message, type = 'success') {
    toastMessage.textContent = message;
    toast.className = `toast ${type}`;
    toast.classList.remove('hidden');
    
    setTimeout(() => {
        toast.classList.add('hidden');
    }, 3000);
}

// Login form submission
loginForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    const email = document.getElementById('login-email').value;
    const password = document.getElementById('login-password').value;
    const loginBtn = document.getElementById('login-btn');
    const btnText = loginBtn.querySelector('.btn-text');
    const loading = loginBtn.querySelector('.loading');
    
    // Show loading state
    btnText.classList.add('hidden');
    loading.classList.remove('hidden');
    loginBtn.disabled = true;
    
    // Simulate login process
    setTimeout(() => {
        // Reset button state
        btnText.classList.remove('hidden');
        loading.classList.add('hidden');
        loginBtn.disabled = false;
        
        // Show success message
        showToast('Login Successful! Welcome back!', 'success');
        
        // Log the attempt (in real app, this would make an API call)
        console.log('Login attempted with:', { email, password });
        
        // Reset form
        loginForm.reset();
    }, 1500);
});

// Register form submission
registerForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    const formData = {
        firstName: document.getElementById('first-name').value,
        lastName: document.getElementById('last-name').value,
        email: document.getElementById('register-email').value,
        password: document.getElementById('register-password').value,
        confirmPassword: document.getElementById('confirm-password').value
    };
    
    const registerBtn = document.getElementById('register-btn');
    const btnText = registerBtn.querySelector('.btn-text');
    const loading = registerBtn.querySelector('.loading');
    
    // Validate passwords match
    if (formData.password !== formData.confirmPassword) {
        showToast('Passwords do not match. Please try again.', 'error');
        return;
    }
    
    // Check if terms are accepted
    const termsAccepted = document.getElementById('accept-terms').checked;
    if (!termsAccepted) {
        showToast('Please accept the terms and conditions to continue.', 'error');
        return;
    }
    
    // Show loading state
    btnText.classList.add('hidden');
    loading.classList.remove('hidden');
    registerBtn.disabled = true;
    
    // Simulate registration process
    setTimeout(() => {
        // Reset button state
        btnText.classList.remove('hidden');
        loading.classList.add('hidden');
        registerBtn.disabled = false;
        
        // Show success message
        showToast('Registration Successful! Your account has been created.', 'success');
        
        // Log the attempt (in real app, this would make an API call)
        console.log('Registration attempted with:', formData);
        
        // Reset form
        registerForm.reset();
    }, 2000);
});

// Initialize password visibility icons
document.querySelectorAll('.eye-icon').forEach(icon => {
    icon.textContent = '👁️';
});

// Add smooth transitions for form elements
document.querySelectorAll('input').forEach(input => {
    input.addEventListener('focus', () => {
        input.parentElement.style.transform = 'translateY(-2px)';
    });
    
    input.addEventListener('blur', () => {
        input.parentElement.style.transform = 'translateY(0)';
    });
});
