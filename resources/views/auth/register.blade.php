<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - E-Dukan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.12);
        }
        .floating-label {
            position: relative;
        }
        .floating-label input:focus + label,
        .floating-label input:not(:placeholder-shown) + label {
            transform: translateY(-1.5rem) scale(0.85);
            color: #a5b4fc;
        }
        .floating-label label {
            position: absolute;
            left: 1rem;
            top: 1rem;
            transition: all 0.3s ease;
            pointer-events: none;
            color: #9ca3af;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">

    <div class="w-full max-w-md">
        <!-- Logo Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full shadow-lg mb-4">
                <i class="fas fa-shopping-bag text-3xl text-emerald-600"></i>
            </div>
            <h1 class="text-2xl font-bold text-white mb-2">E-Dukan</h1>
            <p class="text-slate-200">Your Premier Shopping Destination</p>
        </div>

        <!-- Registration Form -->
        <div class="glass-effect rounded-3xl shadow-2xl p-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-white mb-2">Create Account ✨</h2>
                <p class="text-slate-200">Join our community today</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Full Name -->
                <div class="floating-label">
                    <input id="name" name="name" type="text" autocomplete="name" required autofocus
                           value="{{ old('name') }}" placeholder="John Doe"
                           class="w-full px-4 py-3 bg-white bg-opacity-90 border-0 rounded-xl text-gray-800 placeholder-transparent input-focus transition-all duration-300 focus:bg-white focus:outline-none">
                    <label for="name" class="text-sm font-medium">
                        <i class="fas fa-user mr-2"></i>Full Name
                    </label>
                    @error('name')
                        <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="floating-label">
                    <input id="email" name="email" type="email" autocomplete="username" required
                           value="{{ old('email') }}" placeholder="john@example.com"
                           class="w-full px-4 py-3 bg-white bg-opacity-90 border-0 rounded-xl text-gray-800 placeholder-transparent input-focus transition-all duration-300 focus:bg-white focus:outline-none">
                    <label for="email" class="text-sm font-medium">
                        <i class="fas fa-envelope mr-2"></i>Email Address
                    </label>
                    @error('email')
                        <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="floating-label">
                    <input id="password" name="password" type="password" autocomplete="new-password" required
                           placeholder="At least 8 characters"
                           class="w-full px-4 py-3 bg-white bg-opacity-90 border-0 rounded-xl text-gray-800 placeholder-transparent input-focus transition-all duration-300 focus:bg-white focus:outline-none">
                    <label for="password" class="text-sm font-medium">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    @error('password')
                        <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="floating-label">
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                           placeholder="Confirm your password"
                           class="w-full px-4 py-3 bg-white bg-opacity-90 border-0 rounded-xl text-gray-800 placeholder-transparent input-focus transition-all duration-300 focus:bg-white focus:outline-none">
                    <label for="password_confirmation" class="text-sm font-medium">
                        <i class="fas fa-check-circle mr-2"></i>Confirm Password
                    </label>
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-start">
                    <input id="terms" name="terms" type="checkbox" required
                           class="mt-1 mr-3 w-4 h-4 text-emerald-600 rounded border-gray-300 focus:ring-emerald-500">
                    <label for="terms" class="text-sm text-white text-opacity-80">
                        I agree to the 
                        <a href="#" class="text-indigo-200 hover:text-white underline">Terms of Service</a> 
                        and 
                        <a href="#" class="text-indigo-200 hover:text-white underline">Privacy Policy</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full py-3 px-6 bg-gradient-to-r from-emerald-600 to-sky-600 text-white font-semibold rounded-xl shadow-lg hover:from-emerald-700 hover:to-sky-700 transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-emerald-500 focus:ring-opacity-50">
                    <i class="fas fa-user-plus mr-2"></i>Create Account
                </button>
            </form>

            <!-- Divider -->
            <div class="my-6 flex items-center">
                <div class="flex-1 border-t border-white border-opacity-30"></div>
                <span class="px-4 text-white text-opacity-70 text-sm">OR</span>
                <div class="flex-1 border-t border-white border-opacity-30"></div>
            </div>

            <!-- Login Link -->
            <div class="text-center">
                <p class="text-white text-opacity-80">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-sky-100 hover:text-white font-semibold transition-colors">
                        Sign in here
                    </a>
                </p>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-6">
            <a href="{{ route('shop.index') }}" class="text-white text-opacity-70 hover:text-white transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Back to Home
            </a>
        </div>
    </div>

</body>
</html>
