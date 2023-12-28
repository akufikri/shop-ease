<!-- resources/views/welcome.blade.php -->

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .hide-scroll-bar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .hide-scroll-bar::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body>
    @php
        $menuItems = [['url' => '/login', 'name' => 'Login'], ['url' => '/register', 'name' => 'Register']];
    @endphp

    <x-Nav-c :menuItems="$menuItems" />
    {{-- content --}}
    <div class="flex justify-center mt-8">
        <div class="max-w-6xl w-full ">
            <div class="grid grid-cols-3 grid-rows-4 gap-4">
                <div class="col-span-2 row-span-4">
                    <div id="default-carousel" class="relative w-full" data-carousel="slide">
                        <!-- Carousel wrapper -->
                        <div class="relative h-56 overflow-hidden rounded-sm md:h-96">
                            <!-- Item 1 -->
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <img src="https://flowbite.com/docs/images/carousel/carousel-1.svg"
                                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                    alt="...">
                            </div>
                            <!-- Item 2 -->
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <img src="https://flowbite.com/docs/images/carousel/carousel-2.svg"
                                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                    alt="...">
                            </div>
                            <!-- Item 3 -->
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <img src="https://flowbite.com/docs/images/carousel/carousel-3.svg"
                                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                    alt="...">
                            </div>
                            <!-- Item 4 -->
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <img src="https://flowbite.com/docs/images/carousel/carousel-4.svg"
                                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                    alt="...">
                            </div>
                            <!-- Item 5 -->
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <img src="https://flowbite.com/docs/images/carousel/carousel-5.svg"
                                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                    alt="...">
                            </div>
                        </div>
                        <!-- Slider indicators -->
                        <div
                            class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                                data-carousel-slide-to="0"></button>
                            <button type="button" class="w-3 h-3 rounded-full" aria-current="false"
                                aria-label="Slide 2" data-carousel-slide-to="1"></button>
                            <button type="button" class="w-3 h-3 rounded-full" aria-current="false"
                                aria-label="Slide 3" data-carousel-slide-to="2"></button>
                            <button type="button" class="w-3 h-3 rounded-full" aria-current="false"
                                aria-label="Slide 4" data-carousel-slide-to="3"></button>
                            <button type="button" class="w-3 h-3 rounded-full" aria-current="false"
                                aria-label="Slide 5" data-carousel-slide-to="4"></button>
                        </div>
                        <!-- Slider controls -->
                        <button type="button"
                            class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                            data-carousel-prev>
                            <span
                                class="inline-flex items-center justify-center w-10 h-10 rounded-sm bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 1 1 5l4 4" />
                                </svg>
                                <span class="sr-only">Previous</span>
                            </span>
                        </button>
                        <button type="button"
                            class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                            data-carousel-next>
                            <span
                                class="inline-flex items-center justify-center w-10 h-10 rounded-sm bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <span class="sr-only">Next</span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="row-span-2 border-2 col-start-3 p-4">
                    <h5 class="text-center mt-14 text-2xl font-medium">Not Banner</h5>
                </div>
                <div class="row-span-2 border-2 col-start-3 row-start-3">
                    <h5 class="text-center mt-14 text-2xl font-medium">Not Banner</h5>
                </div>
            </div>

            <div class="mt-10">
                <div class="flex flex-col bg-white m-auto p-auto">
                    <div class="flex overflow-x-scroll pb-10 hide-scroll-bar">
                        <div class="flex flex-nowrap lg:ml-40 md:ml-20 ml-10 ">
                            <div class="inline-block">
                                <div
                                    class="w-24 h-24 border-2 max-w-xs overflow-hidden   bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                                </div>
                            </div>
                            <div class="inline-block">
                                <div
                                    class="w-24 h-24 border-2 max-w-xs overflow-hidden   bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                                </div>
                            </div>
                            <div class="inline-block">
                                <div
                                    class="w-24 h-24 border-2 max-w-xs overflow-hidden   bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                                </div>
                            </div>
                            <div class="inline-block">
                                <div
                                    class="w-24 h-24 border-2 max-w-xs overflow-hidden   bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                                </div>
                            </div>
                            <div class="inline-block">
                                <div
                                    class="w-24 h-24 border-2 max-w-xs overflow-hidden   bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                                </div>
                            </div>
                            <div class="inline-block">
                                <div
                                    class="w-24 h-24 border-2 max-w-xs overflow-hidden   bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                                </div>
                            </div>
                            <div class="inline-block">
                                <div
                                    class="w-24 h-24 border-2 max-w-xs overflow-hidden   bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                                </div>
                            </div>
                            <div class="inline-block">
                                <div
                                    class="w-24 h-24 border-2 max-w-xs overflow-hidden   bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                                </div>
                            </div>
                            <div class="inline-block">
                                <div
                                    class="w-24 h-24 border-2 max-w-xs overflow-hidden   bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                                </div>
                            </div>
                            <div class="inline-block">
                                <div
                                    class="w-24 h-24 border-2 max-w-xs overflow-hidden   bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                                </div>
                            </div>
                            <div class="inline-block">
                                <div
                                    class="w-24 h-24 border-2 max-w-xs overflow-hidden   bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                                </div>
                            </div>
                            <div class="inline-block">
                                <div
                                    class="w-24 h-24 border-2 max-w-xs overflow-hidden   bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                                </div>
                            </div>
                            <div class="inline-block">
                                <div
                                    class="w-24 h-24 border-2 max-w-xs overflow-hidden   bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    {{-- content --}}
</body>

</html>
