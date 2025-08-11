<section id="date"
    class="relative h-screen flex flex-col items-center justify-center bg-cover bg-center bg-no-repeat overflow-hidden px-4 text-center"
    style="background-image: url('{{ asset('assets/images/background-cream.png') }}');">

    <img class="date-flower-1 absolute bottom-0 right-0 lg:w-[20%] md:w-[30%] w-[40%] h-auto z-10"
        src="{{ asset('assets/images/flower-1.png') }}" alt="flower" />
    <img class="date-flower-2 absolute lg:top-[80px] top-[-60px] lg:left-[-180px] left-[-100px] lg:w-[30%] md:w-[40%] w-[50%] h-auto z-10"
        src="{{ asset('assets/images/flower-2.png') }}" alt="flower" />

    <div class="relative z-20 w-full max-w-3xl space-y-4">
        <h2 class="font-dmSerif text-sm md:text-base lg:text-lg text-[#641b0f]">
            Majelis Pernikahan akan berlangsung pada
        </h2>

        <div class="space-y-1">
            <div class="font-rouge font-bold text-3xl md:text-4xl lg:text-5xl text-[#641b0f]">Jum’at</div>
            <div class="font-raleway text-sm md:text-base lg:text-lg text-[#641b0f]">05.09.2025</div>
        </div>

        <div class="space-y-1">
            <h3 class="font-dmSerif text-sm md:text-base lg:text-lg text-[#641b0f]">Resepsi:</h3>
            <div class="font-raleway text-sm md:text-base lg:text-lg text-[#641b0f]">09.00 - 11.00</div>
        </div>

        <img src="{{ asset('assets/images/line-decor.png') }}" class="date-line-decor w-[60%] md:w-[15%] h-auto mx-auto my-1"
            alt="line" />

        <div class="space-y-1">
            <h3 class="font-dmSerif text-sm md:text-base lg:text-lg text-[#641b0f]">Lokasi Majelis</h3>
            <div class="font-rouge font-bold text-2xl md:text-3xl lg:text-4xl text-[#641b0f]">
                Gedung Pertemuan Widya Kartika
            </div>
            <div class="font-dmSerif text-sm md:text-base lg:text-lg text-[#641b0f]">
                (Jl. Dukuh Kupang Timur XIII No.12, Pakis, Sawahan, Surabaya)
            </div>
            <a href="https://maps.app.goo.gl/GnmbPiMrJWQZP1yY9?g_st=ipc" target="_blank" class="relative overflow-hidden group text-2xl font-brittany rounded-full 
          bg-[#fffded] text-[#641b0f] shadow-lg shadow-[#fffded]/20
          transition-transform duration-300 ease-out hover:scale-105 mt-5 inline-block">
                <span class="absolute inset-0 bg-gradient-to-r from-red-200 via-white to-red-200
                 transform -translate-x-full group-hover:translate-x-0
                 transition-transform duration-500 ease-out"></span>

                <span class="relative z-10 flex items-center gap-2 px-5 py-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.657 16.657L13.414 12.414a4 4 0 1 0-1.414 1.414l4.243 4.243a1 1 0 0 0 1.414-1.414z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                    </svg>
                    Click Here for Location
                </span>
            </a>
        </div>
    </div>
</section>