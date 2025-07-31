<div id="gallery" class="page-section h-screen w-screen flex flex-col items-center justify-center 
           bg-cover bg-center bg-no-repeat hidden"
    style="background-image: url('{{ asset('assets_new/images/background-red.png') }}');">

    <div class="absolute top-28 w-full text-center z-10">
        <h2 class="font-brittany text-7xl text-white">
            Piece of our Memories
        </h2>
    </div>

    <img class="gallery-leaf-r absolute top-[300px] right-[-100px] w-[20%] h-auto z-10"
        src="{{ asset('assets_new/images/gallery-leaf-r.png') }}" alt="flower" />

    <img class="gallery-flower-r absolute bottom-0 right-[-60px] w-[20%] h-auto z-20"
        src="{{ asset('assets_new/images/gallery-flower-r.png') }}" alt="flower" />

    <img class="gallery-leaf-l absolute top-[200px] left-[-100px] w-[20%] h-auto z-10"
        src="{{ asset('assets_new/images/gallery-leaf-l.png') }}" alt="flower" />

    <img class="gallery-flower-l absolute bottom-[-100px] left-[-200px] w-[35%] h-auto z-20"
        src="{{ asset('assets_new/images/gallery-flower-l.png') }}" alt="flower" />

    <div class="relative z-10 w-full max-w-4xl grid grid-cols-3 gap-4">
        <div class="col-span-2 row-span-2 grid grid-cols-2 grid-rows-2 gap-4">
            <img src="{{asset('assets_new/images/galeri-1.png')}}" alt="Couple 1"
                class="gallery-image w-full h-full object-cover rounded-xl shadow-lg transition-transform duration-300 hover:scale-105" />
            <img src="{{asset('assets_new/images/galeri-2.png')}}" alt="Couple 2"
                class="gallery-image w-full h-full object-cover rounded-xl shadow-lg transition-transform duration-300 hover:scale-105" />
            <img src="{{asset('assets_new/images/galeri-3.png')}}" alt="Couple 3"
                class="gallery-image w-full h-full object-cover rounded-xl shadow-lg transition-transform duration-300 hover:scale-105" />
            <img src="{{asset('assets_new/images/galeri-4.png')}}" alt="Couple 4"
                class="gallery-image w-full h-full object-cover rounded-xl shadow-lg transition-transform duration-300 hover:scale-105" />
        </div>

        <img src="{{asset('assets_new/images/galeri-5.png')}}" alt="Couple 5"
            class="row-span-2 w-full h-full object-cover rounded-xl shadow-lg transition-transform duration-300 hover:scale-105" />
    </div>
</div>