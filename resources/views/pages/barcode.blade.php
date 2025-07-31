<div id="barcode" class="page-section h-screen w-screen flex flex-col items-center justify-center 
           bg-cover bg-center bg-no-repeat hidden"
    style="background-image: url('{{ asset('assets_new/images/background-red.png') }}');">
    <img class="barcode-flower-t absolute top-0 w-[25%] h-auto z-20"
        src="{{ asset('assets_new/images/flower-on-top.png') }}" alt="flower" />
    <img class="barcode-flower-r absolute bottom-0 right-0 w-[25%] h-auto z-20"
        src="{{ asset('assets_new/images/couple-flower-r.png') }}" alt="flower" />
    <img class="barcode-flower-l absolute bottom-0 left-0 w-[25%] h-auto z-20"
        src="{{ asset('assets_new/images/couple-flower-l.png') }}" alt="flower" />

    <div
        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full text-center z-10 px-4 max-w-screen-sm">
        <h2 class="font-dmSerif text-2xl sm:text-3xl md:text-4xl text-white leading-relaxed">
            Barcode <br>
            to enter our wedding
        </h2>

        <div class="mt-6 sm:mt-10">
            <img src="{{asset('assets_new/images/barcode2.png')}}"
                class="mx-auto max-w-[250px] sm:max-w-xs md:max-w-sm w-full" />
        </div>
    </div>
</div>