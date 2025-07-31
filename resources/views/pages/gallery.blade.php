<div id="gallery" class="page-section h-screen w-screen flex items-center justify-center 
    bg-cover bg-center bg-no-repeat hidden relative overflow-hidden"
    style="background-image: url('{{ asset('assets_new/images/background-red.png') }}');">

    <!-- Centered Content Wrapper -->
    <div class="relative z-10 flex flex-col items-center justify-center text-center px-4 w-full max-w-6xl">
        <!-- Heading -->
        <h2 class="font-brittany text-white text-4xl sm:text-5xl md:text-6xl lg:text-7xl mb-8 leading-tight">
            Piece of our Memories
        </h2>

        <!-- Gallery Grid -->
        <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- 4 Images in a grid -->
            <div class="col-span-1 sm:col-span-2 grid grid-cols-2 grid-rows-2 gap-4">
                <img src="{{ asset('assets_new/images/galeri-1.png') }}" alt="Couple 1"
                    class="w-full h-full object-cover rounded-xl shadow-lg transition-transform duration-300 hover:scale-105" />
                <img src="{{ asset('assets_new/images/galeri-2.png') }}" alt="Couple 2"
                    class="w-full h-full object-cover rounded-xl shadow-lg transition-transform duration-300 hover:scale-105" />
                <img src="{{ asset('assets_new/images/galeri-3.png') }}" alt="Couple 3"
                    class="w-full h-full object-cover rounded-xl shadow-lg transition-transform duration-300 hover:scale-105" />
                <img src="{{ asset('assets_new/images/galeri-4.png') }}" alt="Couple 4"
                    class="w-full h-full object-cover rounded-xl shadow-lg transition-transform duration-300 hover:scale-105" />
            </div>

            <!-- Extra image (desktop only) -->
            <img src="{{ asset('assets_new/images/galeri-5.png') }}" alt="Couple 5"
                class="w-full h-full object-cover rounded-xl shadow-lg transition-transform duration-300 hover:scale-105 hidden lg:block" />
        </div>
    </div>

    <!-- Decorative Absolute Images -->
    <img class="absolute top-[300px] right-[-80px] w-[25%] sm:w-[20%] h-auto z-10 hidden sm:block"
        src="{{ asset('assets_new/images/gallery-leaf-r.png') }}" alt="flower" />
    <img class="absolute bottom-0 right-[-40px] w-[25%] sm:w-[20%] h-auto z-20 hidden sm:block"
        src="{{ asset('assets_new/images/gallery-flower-r.png') }}" alt="flower" />
    <img class="absolute top-[200px] left-[-80px] w-[25%] sm:w-[20%] h-auto z-10 hidden sm:block"
        src="{{ asset('assets_new/images/gallery-leaf-l.png') }}" alt="flower" />
    <img class="absolute bottom-[-80px] left-[-120px] w-[30%] sm:w-[25%] h-auto z-20 hidden sm:block"
        src="{{ asset('assets_new/images/gallery-flower-l.png') }}" alt="flower" />
</div>