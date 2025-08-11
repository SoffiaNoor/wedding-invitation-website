<nav id="bottomNav" class="group fixed bottom-6 left-1/2 transform -translate-x-1/2
    w-16 hover:w-[90%] max-w-xl h-16
    shadow-2xl rounded-full 
    transition-[width] duration-1000 ease-in-out
    flex flex-row items-center justify-center hover:justify-around 
    px-3 z-50 backdrop-blur-md overflow-hidden bg-[#fffded]">

    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2
           flex flex-col items-center justify-center 
           group-hover:opacity-0 group-hover:scale-90 group-hover:pointer-events-none
           transition-all duration-700 ease-in-out z-10">

        <div class="font-dmSerif text-[#651d0b] rounded-full px-4 py-2 
               transition-all duration-500 group-hover:scale-90 flex flex-col items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <span class="text-[10px] font-medium tracking-wide">Menu</span>
        </div>
    </div>

    <div
        class="flex items-center gap-x-6 px-4 overflow-x-auto whitespace-nowrap scrollbar-hide opacity-0 group-hover:opacity-100 transition-all duration-700 ease-in-out z-20">
        <button onclick="scrollToSection('opening')"
            class="font-dmSerif text-[#651d0b] flex flex-col items-center text-sm hover:scale-105 hover:text-[#641b0f] transition duration-300">
            <svg xmlns=" http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            <span class="text-[10px] font-medium tracking-wide">Opening</span>
        </button>

        <button onclick="scrollToSection('couple')"
            class="font-dmSerif text-[#651d0b] flex flex-col items-center text-sm hover:scale-105 hover:text-[#641b0f] transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path
                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                </path>
            </svg>
            <span class="text-[10px] font-medium tracking-wide">Couple</span>
        </button>
        <button onclick="scrollToSection('date')"
            class="font-dmSerif text-[#651d0b] flex flex-col items-center text-sm hover:scale-105 hover:text-[#641b0f] transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            <span class="text-[10px] font-medium tracking-wide">Date</span>
        </button>
        <button onclick="scrollToSection('quotes')"
            class="font-dmSerif text-[#651d0b] flex flex-col items-center text-sm hover:scale-105 hover:text-[#641b0f] transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
            <span class="text-[10px] font-medium tracking-wide">Quotes</span>
        </button>
        <button onclick="scrollToSection('barcode')"
            class="font-dmSerif text-[#651d0b] flex flex-col items-center text-sm hover:scale-105 hover:text-[#641b0f] transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7"></rect>
                <rect x="14" y="3" width="7" height="7"></rect>
                <rect x="14" y="14" width="7" height="7"></rect>
                <rect x="3" y="14" width="7" height="7"></rect>
            </svg>
            <span class="text-[10px] font-medium tracking-wide">Barcode</span>
        </button>
        <button onclick="scrollToSection('gallery')"
            class="font-dmSerif text-[#651d0b] flex flex-col items-center text-sm hover:scale-105 hover:text-[#641b0f] transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2" />
                <circle cx="8.5" cy="8.5" r="1.5" />
                <path d="M20.4 14.5L16 10 4 20" />
            </svg>
            <span class="text-[10px] font-medium tracking-wide">Gallery</span>
        </button>
        <button onclick="scrollToSection('wedding-gift')"
            class="font-dmSerif text-[#651d0b] flex flex-col items-center text-sm hover:scale-105 hover:text-[#641b0f] transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="4" width="20" height="16" rx="2" />
                <path d="M7 15h0M2 9.5h20" />
            </svg>
            <span class="text-[10px] font-medium tracking-wide">Wedding Gift</span>
        </button>
    </div>

</nav>