<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Dukan</title>
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

        <!-- Login Form -->
        <div class="glass-effect rounded-3xl shadow-2xl p-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-white mb-2">Welcome Back 👋</h2>
                <p class="text-slate-200">Sign in to your account</p>
            </div>

            @if (session('status'))
                <div class="mb-6 p-4 bg-green-500 bg-opacity-20 border border-green-400 rounded-lg text-green-100 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-white mb-2">
                        <i class="fas fa-envelope mr-2"></i>Email Address
                    </label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                           class="w-full px-4 py-3 bg-white bg-opacity-90 border-0 rounded-xl text-gray-800 placeholder-gray-500 input-focus transition-all duration-300 focus:bg-white focus:outline-none">
                    @error('email')
                        <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-white mb-2">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    <input id="password" name="password" type="password" required autocomplete="current-password"
                           class="w-full px-4 py-3 bg-white bg-opacity-90 border-0 rounded-xl text-gray-800 placeholder-gray-500 input-focus transition-all duration-300 focus:bg-white focus:outline-none">
                    @error('password')
                        <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center text-white">
                        <input id="remember_me" name="remember" type="checkbox"
                               class="mr-2 w-4 h-4 text-emerald-600 rounded border-gray-300 focus:ring-emerald-500">
                        <span class="text-sm">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-sm text-slate-200 hover:text-white transition-colors">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full py-3 px-6 bg-gradient-to-r from-emerald-600 to-sky-600 text-white font-semibold rounded-xl shadow-lg hover:from-emerald-700 hover:to-sky-700 transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-emerald-500 focus:ring-opacity-50">
                    <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                </button>
            </form>

            <!-- Divider -->
            <div class="my-6 flex items-center">
                <div class="flex-1 border-t border-white border-opacity-30"></div>
                <span class="px-4 text-white text-opacity-70 text-sm">OR</span>
                <div class="flex-1 border-t border-white border-opacity-30"></div>
            </div>

            <!-- Register Link -->
            <div class="text-center">
                <p class="text-white text-opacity-80">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-sky-100 hover:text-white font-semibold transition-colors">
                        Create one now
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
