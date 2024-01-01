@extends('frontend.template')
@section('content')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    {{-- banner --}}
    <div id="default-carousel" class="relative w-full" data-carousel="slide">
        <div class="relative h-56 overflow-hidden rounded-md md:h-80">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://flowbite.com/docs/images/carousel/carousel-1.svg"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://flowbite.com/docs/images/carousel/carousel-2.svg"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://flowbite.com/docs/images/carousel/carousel-3.svg"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 4 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://flowbite.com/docs/images/carousel/carousel-4.svg"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 5 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://flowbite.com/docs/images/carousel/carousel-5.svg"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4"
                data-carousel-slide-to="3"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5"
                data-carousel-slide-to="4"></button>
        </div>
        <!-- Slider controls -->
        <button type="button"
            class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-prev>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-sm bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4" />
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
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>
    {{-- kategori --}}
    <div class="flex justify-center">
        <div class="grid grid-cols-4 md:grid-cols-7 sm:grid-cols-6 lg:grid-cols-8 mt-5 gap-3 kategori">

        </div>
    </div>
    {{-- produk terbaru --}}
    <div class="grid sm:p-0 p-4 md:grid-cols-3 sm:grid-cols-3 grid-cols-2 lg:grid-cols-3 mt-20 gap-4 produk">


    </div>

    {{-- js --}}
    <script>
        $(document).ready(function() {
            getAllKategori();
            getAllProduk();
        });

        function getAllKategori() {
            $.ajax({
                type: "GET",
                url: "/kategori/get",
                success: function(response) {
                    var kategoriContainer = $(".kategori"); // Ganti sesuai dengan elemen yang sesuai
                    kategoriContainer.empty(); // Mengosongkan kontainer sebelum menambahkan kategori

                    // Memastikan respons memiliki properti 'data' yang merupakan array sebelum menggunakan forEach
                    if (response && Array.isArray(response.data)) {
                        // Menambahkan kategori ke dalam kontainer berdasarkan data yang diterima
                        response.data.forEach(function(kategori) {
                            var kategoriElement = `
                            <button class="shadow-lg h-24">
                                <div class="p-4">
                                    <img src="${kategori.logo}" alt="${kategori.name} Logo" class="sm:w-full h-15 w-12 sm:h-full object-cover">
                                </div>
                            </button>
                        `;
                            kategoriContainer.append(kategoriElement);
                        });
                    } else {
                        console.error("Respons tidak memiliki properti 'data' yang merupakan array:", response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Terjadi kesalahan:", status, error);
                }
            });
        }

        function getAllProduk() {
            $.ajax({
                type: "GET",
                url: "/produk/get",
                success: function(response) {
                    var ProdukContainer = $('.produk')
                    ProdukContainer.empty();

                    // console.log(response.data)
                    if (response && Array.isArray(response.data)) {
                        response.data.forEach(function(produk) {
                            var produkElement = `
                    <div class="sm:h-auto border-2 rounded-md">
                                <div class="overflow-hidden">
                                    <img class="object-cover w-full max-w-64" src="https://placehold.co/400" alt="">
                                </div>
                                <div class="p-4 text-center">
                                    <span class="font-medium">${produk.produk_name}</span>
                                    <h2 class="lg:text-xl md:text-lg sm:text-sm text-xs font-bold">
                                        Rp.${produk.harga}
                                    </h2>
                                </div>
                                <hr>
                                <div class="px-5 p-3 mt-3">
                                    <div class="flex  justify-between">
                                        <div class="font-medium">
                                            Rate 5/10
                                        </div>
                                        <button class="bg-gray-900 text-base text-white px-4 py-1 rounded-md">
                                            <i class="fa-solid fa-cart-plus"></i>
                                        </button>
                                        <button class="bg-gray-900 text-base text-white px-4 py-1 rounded-md">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            `;
                            ProdukContainer.append(produkElement)
                        })
                    }
                }
            });
        }
    </script>
@endsection
