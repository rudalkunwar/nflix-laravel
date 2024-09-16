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
    style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url(./img/bg.jpg); font-family: Helvetica">

    <!-- Logo -->
    <div class="py-5 px-10">
        <a class="fill-[#e50914]" href="#">
            <i class="ri-netflix-fill text-4xl text-[#e50914]"></i>
        </a>
    </div>

    <!-- Form -->
    <div
        class="max-w-sm sm:max-w-md m-auto my-5 py-10 px-8 sm:py-16 sm:px-16 bg-black bg-opacity-80 text-white rounded-md">
        <form action="">
            <h3 class="text-4xl font-bold mb-8">Sign In</h3>

            <input type="email"
                class="block w-full py-3.5 px-5 bg-[#333] focus:bg-[#454545] rounded focus:outline-0 focus:ring-0 focus:border-none border-none placeholder:text-[#8c8c8c]"
                placeholder="Email or phone number" required>

            <input type="password"
                class="block w-full mt-4 py-3.5 px-5 bg-[#333] focus:bg-[#454545] rounded focus:outline-0 focus:ring-0 focus:border-none placeholder:text-[#8c8c8c] border-none"
                placeholder="Password" required>

            <input type="submit" value="Sign In"
                class="py-3.5 mt-8 bg-[#e50914] text-center block w-full rounded hover:cursor-pointer font-bold text-lg">

            <div class="flex justify-between pt-2 text-sm text-gray-400">
                <div>
                    <input type="checkbox" id="me" class="rounded checked:bg-gray-500 focus:ring-0">
                    <label for="me" class="ml-0.5">Remember me</label>
                </div>
                <div><a href="#" class="hover:underline">Need help?</a></div>
            </div>
            <div class="pt-3 text-gray-500 text-lg">
                New to Netflix? <a href="#"
                    class="hover:underline hover:cursor-pointer text-white font-semibold">Sign up
                    now</a>.
            </div>
        </form>
    </div>

</body>

</html>
