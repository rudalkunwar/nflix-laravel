<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">

    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 shadow-lg rounded-lg max-w-md w-full">
            <!-- Heading Section -->
            <div class="text-center mb-6">
                <i class="ri-mail-check-line text-blue-600 text-4xl mb-2"></i>
                <h2 class="text-2xl font-semibold mb-4">Email Verification</h2>
                <p class="text-sm text-gray-600">
                    Thanks for signing up! Before getting started, please verify your email address by clicking the link
                    we just sent you. If you didn't receive the email, we'll send you another one.
                </p>
            </div>

            <!-- Status Message -->
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 p-2 text-green-600 bg-green-100 rounded text-center">
                    A new verification link has been sent to your email address.
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex items-center justify-between">
                <!-- Resend Email Button -->
                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow-md transition duration-200">
                        <i class="ri-refresh-line mr-2"></i>Resend Email
                    </button>
                </form>

                <!-- Log Out Button -->
                <form method="POST" action="{{ route('user.logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-600 hover:text-gray-900 underline text-sm">
                        <i class="ri-logout-box-line mr-2"></i>Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
