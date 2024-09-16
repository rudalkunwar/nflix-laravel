<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
</head>

<body>
    <div>
        <!-- Main Section -->
        <div class="h-screen flex justify-center items-center bg-cover bg-center"
            style="background-image: linear-gradient(rgb(0 0 0 / 60%), rgb(0 0 0 / 60%)), url('https://assets.nflxext.com/ffe/siteui/vlv3/c0a32732-b033-43b3-be2a-8fee037a6146/2fe6e3c0-5613-4625-a0c1-3d605effd10b/IN-en-20210607-popsignuptwoweeks-perspective_alpha_website_large.jpg')">
            <!-- Netflix Logo -->
            <div class="absolute top-0 left-0 mt-5 ml-5">
                <a href="#">
                    <i class="ri-netflix-fill text-5xl text-[#e50914]"></i>
                </a>
            </div>
            <!-- Sign In Button -->
            <button class="absolute bg-red-600 hover:bg-red-700 text-white p-3 top-0 right-0 mt-3 mr-5">Sign In</button>
            <!-- Main Content -->
            <div class="space-y-5">
                <p class="text-white font-bold text-5xl flex flex-col items-center">
                    <span>Unlimited movies, TV <br /></span>
                    <span> shows and more. </span>
                </p>
                <p class="text-white font-semibold text-3xl flex flex-col items-center">Watch anywhere. Cancel anytime.
                </p>
                <p class="text-white text-lg flex flex-col items-center">Ready to watch? Enter your email to create or
                    restart your membership.</p>
                <div class="flex flex-row items-center justify-center">
                    <input type="text" placeholder="Email address"
                        class="p-4 focus:outline-none focus:ring-1 focus:ring-blue-300 w-3/4" />
                    <button class="p-4 text-l font-semibold bg-red-600 hover:bg-red-700 text-white">Get Started
                        ></button>
                </div>
            </div>
        </div>

        <!-- Section 1 -->
        <hr />
        <div class="h-screen flex items-center justify-center bg-black p-5">
            <div class="space-y-5 p-5">
                <p class="text-white font-bold text-4xl">Enjoy on your TV.</p>
                <p class="text-white font-semibold text-xl">Watch on smart TVs, PlayStation, Xbox, Chromecast, Apple TV,
                    Blu-ray players, and more.</p>
            </div>
            <div>
                <img alt="TV"
                    src="https://assets.nflxext.com/ffe/siteui/acquisition/ourStory/fuji/desktop/tv.png" />
            </div>
        </div>

        <!-- Section 2 -->
        <hr />
        <div class="h-screen flex items-center justify-center bg-black p-5">
            <div>
                <img alt="" class="our-story-card-img"
                    src="https://assets.nflxext.com/ffe/siteui/acquisition/ourStory/fuji/desktop/mobile-0819.jpg" />
            </div>
            <div class="space-y-5">
                <p class="text-white font-bold text-4xl">Download your shows to watch offline.</p>
                <p class="text-white font-semibold text-xl">Save your favourites easily and always have something to
                    watch.</p>
            </div>
        </div>

        <!-- Section 3 -->
        <hr />
        <div class="h-screen flex items-center justify-center bg-black p-5">
            <div class="space-y-5 p-5">
                <p class="text-white font-bold text-4xl">Watch everywhere.</p>
                <p class="text-white font-semibold text-xl">Stream unlimited movies and TV shows on your phone, tablet,
                    laptop, and TV.</p>
            </div>
            <div>
                <img alt="" class="our-story-card-img"
                    src="https://assets.nflxext.com/ffe/siteui/acquisition/ourStory/fuji/desktop/device-pile-in.png" />
            </div>
        </div>

        <!-- Section 4 -->
        <hr />
        <div class="h-screen flex items-center justify-center bg-black p-5">
            <div class="p-5">
                <img alt="" class="our-story-card-img"
                    src="https://occ-0-5556-3662.1.nflxso.net/dnm/api/v6/19OhWN2dO19C9txTON9tvTFtefw/AAAABVxdX2WnFSp49eXb1do0euaj-F8upNImjofE77XStKhf5kUHG94DPlTiGYqPeYNtiox-82NWEK0Ls3CnLe3WWClGdiJP.png?r=5cf" />
            </div>
            <div class="space-y-5">
                <p class="text-white font-bold text-4xl">Create profiles for children.</p>
                <p class="text-white font-semibold text-xl">Send children on adventures with their favourite characters
                    in a space made just for them—free with your membership.</p>
            </div>
        </div>

        <!-- FAQ Section -->
        <hr />
        <div class="min-h-screen bg-black py-10">
            <p class="px-4 py-5 text-white font-extrabold text-3xl sm:text-4xl md:text-5xl flex justify-center">
                Frequently Asked Questions
            </p>
            <div class="flex flex-col md:flex-row items-center justify-center space-y-5 md:space-y-0 md:space-x-10">
                <div class="hidden md:flex w-1/2 justify-center items-center">
                    <i class="ri-question-fill text-5xl text-white"></i>
                </div>
                <div class="space-y-5 w-full sm:w-5/6 md:w-3/4">
                    <!-- Question 1 -->
                    <div class="p-4 sm:p-5 bg-[#303030] rounded-lg hover:bg-[#404040] transition duration-300 ease-in-out cursor-pointer"
                        onclick="toggleAnswer('answer1')">
                        <div class="flex items-center">
                            <i class="ri-question-line text-2xl sm:text-3xl text-red-500 mr-4"></i>
                            <p class="text-xl sm:text-2xl md:text-3xl text-white">What is Netflix?</p>
                        </div>
                        <div id="answer1" class="mt-3 hidden">
                            <p class="text-white text-sm sm:text-base md:text-lg">Netflix is a streaming service that
                                offers a wide variety of TV shows, movies, anime, documentaries, and more on thousands
                                of internet-connected devices.</p>
                        </div>
                    </div>
                    <!-- Question 2 -->
                    <div class="p-4 sm:p-5 bg-[#303030] rounded-lg hover:bg-[#404040] transition duration-300 ease-in-out cursor-pointer"
                        onclick="toggleAnswer('answer2')">
                        <div class="flex items-center">
                            <i class="ri-money-dollar-circle-line text-2xl sm:text-3xl text-red-500 mr-4"></i>
                            <p class="text-xl sm:text-2xl md:text-3xl text-white">How much does Netflix cost?</p>
                        </div>
                        <div id="answer2" class="mt-3 hidden">
                            <p class="text-white text-sm sm:text-base md:text-lg">Netflix offers different pricing plans
                                to suit your needs. You can check the current pricing on their official website.</p>
                        </div>
                    </div>
                    <!-- Question 3 -->
                    <div class="p-4 sm:p-5 bg-[#303030] rounded-lg hover:bg-[#404040] transition duration-300 ease-in-out cursor-pointer"
                        onclick="toggleAnswer('answer3')">
                        <div class="flex items-center">
                            <i class="ri-tv-line text-2xl sm:text-3xl text-red-500 mr-4"></i>
                            <p class="text-xl sm:text-2xl md:text-3xl text-white">Where can I watch?</p>
                        </div>
                        <div id="answer3" class="mt-3 hidden">
                            <p class="text-white text-sm sm:text-base md:text-lg">Watch anywhere, anytime, on an
                                unlimited number of devices. Sign in with your Netflix account to watch instantly on the
                                web at netflix.com from your personal computer or on any internet-connected device.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function toggleAnswer(id) {
                const answer = document.getElementById(id);
                answer.classList.toggle('hidden');
            }
        </script>

    </div>
</body>

</html>
