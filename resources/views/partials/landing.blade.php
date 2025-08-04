<section id="landing"
    class="relative h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat overflow-hidden"
    style="background-image: url('{{ asset('assets/images/background-red.png') }}');">

    <img id="flower1"
        class="absolute right-[-60px] lg:bottom-[-120px] bottom-[-50px] lg:w-[30%] md:w-[40%] w-[50%] h-auto z-20"
        src="{{ asset('assets/images/flower-1.png') }}" alt="flower" />
    <img id="flower2"
        class="absolute left-[-60px] lg:left-[-200px] lg:top-[-120px] top-[-80px] lg:w-[30%] md:w-[40%] w-[50%] h-auto z-20"
        src="{{ asset('assets/images/flower-2.png') }}" alt="flower" />


    <img id="borderTR" class="absolute top-[20px] right-[20px] lg:w-[10%] w-[25%] h-auto z-20"
        src="{{ asset('assets/images/border-tr.png') }}" />
    <img id="borderBL" class="absolute bottom-[20px] left-[20px] lg:w-[10%] w-[25%] h-auto z-20"
        src="{{ asset('assets/images/border-bl.png') }}" />

    <div class="z-30 text-center flex flex-col items-center justify-center w-full">
        <h2 class="font-brittany text-white text-4xl md:text-6xl lg:text-7xl mb-2">
            The Wedding Of
        </h2>

        <div class="relative w-[40%] md:w-[40%] lg:w-[20%] aspect-square mx-auto">
            <img id="circle" class="absolute inset-0 w-full h-full object-contain z-10"
                src="{{ asset('assets/images/circle.png') }}" />
            <img id="nz"
                class="absolute top-1/2 left-1/2 w-[50%] lg:w-[60%] h-auto z-20 transform -translate-x-1/2 -translate-y-1/2"
                src="{{ asset('assets/images/nz.png') }}" />
        </div>

        <div class="text-white text-lg md:text-xl font-dmSerif mt-2">
            To: {{$invitation->name}}
        </div>

        <button id="openBtn" class="relative overflow-hidden group text-2xl font-brittany rounded-full 
               bg-[#fffded] text-[#641b0f] shadow-lg shadow-[#fffded]/20
               transition-transform duration-300 ease-out
               hover:scale-105 mt-4">
            <span class="absolute inset-0 bg-gradient-to-r from-red-200 via-white to-red-200
                     transform -translate-x-full group-hover:translate-x-0
                     transition-transform duration-500 ease-out"></span>

            <span class="relative z-10 flex items-center gap-2 px-10 py-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                    <polyline points="22,6 12,13 2,6" />
                </svg>
                Open Invitation
            </span>
        </button>
    </div>
</section>