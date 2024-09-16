<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nflix</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="relative h-screen">
        <img class="absolute inset-0 w-full h-full object-cover" src="{{ asset('nflix-cover.jpg') }}" alt="Cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/5 via-transparent to-black"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/5 via-transparent to-black"></div>

        <div class="relative z-10 flex flex-col h-full">
            <header class="container mx-auto flex justify-between items-center px-4 md:px-10">
                <img class="w-28 md:w-40 h-auto" src="{{ asset('nflix-logo.png') }}" alt="Nflix Logo">
                <a href="{{ route('login') }}" class="text-white px-4 py-2 rounded-md"
                    style="background-color: #E50914;">Sign In</a>
            </header>

            <main class="flex-grow flex flex-col justify-center items-center text-center px-4 md:px-10">
                <h1 class="text-xl md:text-5xl lg:text-6xl text-white font-bold max-w-2xl mb-4">Unlimited movies, TV
                    shows, and more.</h1>
                <h2 class="text-md md:text-2xl lg:text-3xl text-white mb-8">Watch anywhere. Cancel anytime.</h2>
                <form action="{{ route('register') }}" method="GET">
                    <div class="text-center md:flex justify-center items-center gap-4">
                        <div class="relative w-full">
                            <input
                                class="py-5 peer w-[200px] md:w-[400px] h-full bg-transparent text-white outline outline-0 focus:outline-0 disabled:bg-white disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-white placeholder-shown:border-t-white border focus:border-2 border-t-transparent focus:border-t-transparent text-md px-3 border-white focus:border-white"
                                placeholder=" " type="email" id="email" name="email" required>
                            <label
                                class="flex w-full h-full select-none pointer-events-none absolute left-0 !overflow-visible truncate peer-placeholder-shown:text-white leading-tight peer-focus:leading-tight peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-white transition-all -top-1.5 peer-placeholder-shown:text-sm text-[16px] peer-focus:text-[16px] before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1 peer-placeholder-shown:before:border-transparent before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none before:transition-all peer-disabled:before:border-transparent after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:border-t peer-focus:after:border-t-2 after:border-r peer-focus:after:border-r-2 after:pointer-events-none after:transition-all peer-disabled:after:border-transparent peer-placeholder-shown:leading-[3.75] text-white peer-focus:text-white before:border-white peer-focus:before:!border-white after:border-white peer-focus:after:!border-white">Email</label>
                        </div>
                        <button type="submit"
                            class="text-white text-xl w-[200px] px-4 py-2 md:px-6 md:py-4 md:w-full mt-4 md:mt-0 rounded-md flex items-center"
                            style="background-color: #E50914;">
                            <span>Get Started</span>
                            <i class="ri-arrow-right-wide-fill text-white text-2xl"></i>
                        </button>
                    </div>
                </form>
            </main>
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
            <img alt="TV" src="https://assets.nflxext.com/ffe/siteui/acquisition/ourStory/fuji/desktop/tv.png" />
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
            <div class="space-y-5 w-full sm:w-5/6 md:w-3/4">
                <!-- Question 1 -->
                <div class="p-4 sm:p-5 bg-[#303030] rounded-lg hover:bg-[#404040] transition duration-300 ease-in-out cursor-pointer"
                    onclick="toggleAnswer('answer1')">
                    <div class="flex items-center">
                        <i class="ri-question-line text-2xl sm:text-3xl text-red-500 mr-4"></i>
                        <p class="text-xl sm:text-2xl md:text-3xl text-white">What is Nflix?</p>
                    </div>
                    <div id="answer1" class="mt-3 hidden">
                        <p class="text-white text-sm sm:text-base md:text-lg">Nflix is a streaming service that
                            offers a wide variety of TV shows, movies, anime, documentaries, and more on thousands
                            of internet-connected devices.</p>
                    </div>
                </div>
                <!-- Question 2 -->
                <div class="p-4 sm:p-5 bg-[#303030] rounded-lg hover:bg-[#404040] transition duration-300 ease-in-out cursor-pointer"
                    onclick="toggleAnswer('answer2')">
                    <div class="flex items-center">
                        <i class="ri-money-dollar-circle-line text-2xl sm:text-3xl text-red-500 mr-4"></i>
                        <p class="text-xl sm:text-2xl md:text-3xl text-white">How much does Nflix cost?</p>
                    </div>
                    <div id="answer2" class="mt-3 hidden">
                        <p class="text-white text-sm sm:text-base md:text-lg">Nflix offers different pricing plans
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
                            unlimited number of devices. Sign in with your Nflix account to watch instantly on the
                            web at nflix.com from your personal computer or on any internet-connected device.</p>
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
    @extends('users.partials.footer')
