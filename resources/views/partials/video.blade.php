<div id="video" class="relative w-full h-screen bg-cover bg-center flex flex-col items-center justify-center"
    style="background-image: url('{{ asset('assets/images/background-red.png') }}');">
    <h2
        class="font-brittany text-white mb-6 text-3xl sm:text-5xl md:text-6xl text-center md:hidden drop-shadow-lg z-30">
        Pre-Wedding Clip
    </h2>
    <video
        class="w-full max-w-md object-contain mx-auto z-0 md:static md:max-w-none md:absolute md:inset-0 md:w-full md:h-full md:object-cover"
        autoplay muted loop playsinline>
        <source src="{{ asset('assets/video/video-prewed.mp4') }}" type="video/mp4">
        Browser kamu tidak mendukung video tag.
    </video>

    <img src="{{ asset('assets/images/border-tr2.png') }}" alt=""
        class="video-border-tr absolute top-[20px] right-[20px] z-40 h-auto w-[30%] sm:w-[20%] md:w-[15%] lg:w-[10%] md:hidden" />
    <img src="{{ asset('assets/images/border-tl.png') }}" alt=""
        class="video-border-tl absolute top-[20px] left-[20px] z-40 h-auto w-[30%] sm:w-[20%] md:w-[15%] lg:w-[10%] md:hidden" />
</div>

@include('partials.footer')