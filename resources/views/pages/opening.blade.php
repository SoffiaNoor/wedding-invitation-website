<div id="opening"
    class="page-section h-screen w-screen flex flex-col items-center justify-between bg-cover bg-center bg-no-repeat hidden relative pb-[80px]"
    style="background-image: url('{{ asset('assets_new/images/background-cream.png') }}');">

    <!-- Decorative Flowers -->
    <img class="opening-flower-1 absolute right-[-60px] lg:bottom-[-120px] md:bottom-[-100px] bottom-[-50px] lg:w-[30%] md:w-[40%] w-[60%] h-auto z-20 flower1"
        src="{{ asset('assets_new/images/flower-1.png') }}" alt="flower" />
    <img class="opening-flower-2 absolute left-[-100px] lg:left-[-200px] lg:bottom-[-120px] bottom-[-50px] lg:w-[30%] md:w-[45%] w-[60%] h-auto z-20 flower2"
        src="{{ asset('assets_new/images/flower-2.png') }}" alt="flower" />

    <!-- Corner Decorations -->
    <img class="absolute top-[30px] right-[30px] lg:w-[10%] md:w-[20%] w-[30%] h-auto z-40"
        src="{{ asset('assets_new/images/border-tr2.png') }}" />
    <img class="absolute top-[30px] left-[30px] lg:w-[10%] md:w-[20%] w-[30%] h-auto z-40"
        src="{{ asset('assets_new/images/border-tl.png') }}" />

    <!-- Content Wrapper (takes remaining height minus bottom navbar) -->
    <div class="flex flex-col justify-center items-center text-center flex-grow w-full z-30 px-4">
        <!-- Title -->
        <h2 class="font-brittany text-[#641b0f] text-5xl md:text-6xl lg:text-7xl mb-8">
            The Wedding Of
        </h2>

        <!-- Center Logo -->
        <img src="{{ asset('assets_new/images/nz.png') }}"
            class="object-cover h-auto w-[60%] md:w-[40%] lg:w-[15%] mb-8" alt="NZ Logo" />

        <!-- Date Text -->
        <div>
            <h2 class="font-dmSerif text-[#641b0f] font-light text-3xl md:text-4xl">
                Jum’at | 05 Sept 2025
            </h2>
            <h2 class="font-dmSerif text-[#641b0f] mt-3 md:mt-5 text-4xl md:text-5xl">
                Save The Date
            </h2>
        </div>
    </div>
</div>