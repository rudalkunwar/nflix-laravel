<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Remix Icon -->
</head>

<body class="antialiased"
    style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url({{ asset('nflix-cover.jpg') }}); font-family: Helvetica">

    <div class="py-4 px-10">
        <a href="{{ route('index') }}">
            <img class="w-32" src="{{ asset('nflix-logo.png') }}" alt="nflix-logo">
        </a>
    </div>

    <div
        class="max-w-sm sm:max-w-md m-auto my-5 py-2 px-8 sm:py-8 sm:px-16 bg-black bg-opacity-80 text-white rounded-md">
        <form action="{{ route('register') }}" method="post" onsubmit="return validateForm()">
            @csrf
            <h3 class="text-4xl font-bold mb-8">Sign Up</h3>

            <input type="name" name="name" value="{{ old('name') }}"
                class="block w-full py-3.5 px-5 bg-[#333] focus:bg-[#454545] rounded focus:outline-0 focus:ring-0 focus:border-none border-none placeholder:text-[#8c8c8c]"
                placeholder="Enter your name" required>
            @error('name')
                <h2 class="text-red-500 py-1">{{ $message }}</h2>
            @enderror
            <input type="email" name="email" @if ($email) value="{{ $email }}" @endif
                class="block w-full mt-5 py-3.5 px-5 bg-[#333] focus:bg-[#454545] rounded focus:outline-0 focus:ring-0 focus:border-none border-none placeholder:text-[#8c8c8c]"
                placeholder="Email or phone number" required>
            @error('email')
                <h2 class="text-red-500 py-1">{{ $message }}</h2>
            @enderror

            <div class="relative">
                <input type="password" name="password" id="password"
                    class="block w-full mt-4 py-3.5 px-5 bg-[#333] focus:bg-[#454545] rounded focus:outline-0 focus:ring-0 focus:border-none placeholder:text-[#8c8c8c] border-none"
                    placeholder="Password" required> <i class="ri-eye-line text-2xl absolute top-3 right-5"
                    onclick="togglePassword('password')"></i>
                @error('password')
                    <h2 class="text-red-500 py-1">{{ $message }}</h2>
                @enderror
            </div>

            <div class="relative">
                <input type="password" name="confirm-password" id="confirm-password"
                    class="block w-full mt-4 py-3.5 px-5 bg-[#333] focus:bg-[#454545] rounded focus:outline-0 focus:ring-0 focus:border-none placeholder:text-[#8c8c8c] border-none"
                    placeholder="Confirm password" required> <i class="ri-eye-off-line text-2xl absolute top-3 right-5"
                    onclick="togglePassword('confirm-password')"></i>
                @error('confirm-password')
                    <h2 class="text-red-500 py-1">{{ $message }}</h2>
                @enderror
            </div>

            <input type="submit" value="Sign In"
                class="py-3.5 mt-8 bg-[#e50914] text-center block w-full rounded hover:cursor-pointer font-bold text-lg">
            <div class="pt-3 text-gray-500 text-lg">
                Already a user ? <a href="{{ route('login') }}"
                    class="hover:underline hover:cursor-pointer text-white font-semibold">Sign in
                    now</a>.
            </div>
        </form>
    </div>

    <script>
        function togglePassword(id) {
            const password = document.getElementById(id);
            password.type === "password" ? password.type = "text" : password.type = "password";
        }

        function validateForm() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            if (password !== confirmPassword) {
                alert("Password doesnot match");
                return false;
            }
            return true;
        }
    </script>

</body>

</html>
