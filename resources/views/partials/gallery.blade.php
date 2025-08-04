<section id="gallery"
    class="relative min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat overflow-hidden"
    style="background-image: url('{{ asset('assets/images/background-red.png') }}');">

    <img class="gallery-leaf-r absolute lg:top-[300px] bottom-[40px] lg:right-[-80px] right-0 lg:w-[25%] w-[30%] h-auto z-10"
        src="{{ asset('assets/images/gallery-leaf-r.png') }}" alt="flower" />
    <img class="gallery-flower-r absolute lg:bottom-0 bottom-0 lg:right-[-40px] right-0 lg:w-[25%] md:w-[30%] w-[40%] h-auto z-20"
        src="{{ asset('assets/images/gallery-flower-r.png') }}" alt="flower" />
    <img class="gallery-leaf-l absolute lg:top-[200px] bottom-[40px] lg:left-[-80px] left-0 lg:w-[20%] w-[30%] h-auto z-10"
        src="{{ asset('assets/images/gallery-leaf-l.png') }}" alt="flower" />
    <img class="gallery-flower-l absolute lg:bottom-[-80px] bottom-0 lg:left-[-120px] left-0 lg:w-[25%] md:w-[25%] w-[35%] h-auto z-20"
        src="{{ asset('assets/images/gallery-flower-l.png') }}" alt="flower" />

    <div class="relative z-10 flex flex-col items-center justify-center text-center px-4 w-full max-w-6xl">
        <h2 class="font-brittany text-white text-3xl md:text-4xl lg:text-5xl mb-8 leading-tight">
            Piece of our Memories
        </h2>

        <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="col-span-1 sm:col-span-2 grid grid-cols-2 grid-rows-2 gap-4">
                <img src="{{ asset('assets/images/galeri-1.png') }}" alt="Couple 1"
                    class="w-full h-full object-cover rounded-xl shadow-lg transition-transform duration-300 hover:scale-105" />
                <img src="{{ asset('assets/images/galeri-2.png') }}" alt="Couple 2"
                    class="w-full h-full object-cover rounded-xl shadow-lg transition-transform duration-300 hover:scale-105" />
                <img src="{{ asset('assets/images/galeri-3.png') }}" alt="Couple 3"
                    class="w-full h-full object-cover rounded-xl shadow-lg transition-transform duration-300 hover:scale-105" />
                <img src="{{ asset('assets/images/galeri-4.png') }}" alt="Couple 4"
                    class="w-full h-full object-cover rounded-xl shadow-lg transition-transform duration-300 hover:scale-105" />
            </div>

            <img src="{{ asset('assets/images/galeri-5.png') }}" alt="Couple 5"
                class="w-full h-full object-cover rounded-xl shadow-lg transition-transform duration-300 hover:scale-105 hidden lg:block" />
        </div>
    </div>
</section>