<div class="bg-white sticky top-0 z-50 shadow-sm">
  <header class="bg-white">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1">
        <div class="flex items-center">
          <a href="#" class="flex items-center">
              <svg class="h-8 w-8 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <span class="ml-2 text-xl font-bold text-gray-900">SaveSmart</span>
          </a>
      </div>
      </div>

      <!-- Mobile menu button -->
      <div class="flex lg:hidden">
        <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700 hover:bg-gray-100 transition-colors" id="mobile-menu-button">
          <span class="sr-only">Open main menu</span>
          <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
      </div>

      <!-- Desktop Menu -->
      <div class="hidden lg:flex lg:flex-1 lg:gap-x-12 lg:items-center lg:justify-between" id="desktop-menu">
        <div class="lg:flex lg:flex-1 lg:gap-x-12 ">
          <a href="/" class="text-sm font-semibold text-gray-900 hover:text-green-600 transition-colors">Home</a>
          {{-- <a href="/books" class="text-sm font-semibold text-gray-900 hover:text-green-600 transition-colors">Books</a> --}}
        </div>
          <div class="flex gap-2">
          @guest
          <a href="/login" class=" bg-white text-gray-900 py-1 px-5  rounded-full border-green-700 border-2 shadow-md transition duration-300 ease-in-out hover:text-green-600 ">Log in <span aria-hidden="true">&rarr;</span></a>
          <a href="/register" class=" bg-green-600 hover:bg-green-700 text-white py-1 px-6  border-green-700 border-2 rounded-full shadow-md transition duration-300 ease-in-out">register  </a>
          @endguest
          @auth
              <a href="{{ route('profiles.index')}}" class=" bg-white text-gray-900 py-1 px-5  transition duration-300 ease-in-out hover:text-green-600 ">Profiles</a>
          <a href="/logout" class=" bg-white text-gray-900 py-1 px-5  rounded-full border-green-700 border-2 shadow-md transition duration-300 ease-in-out hover:text-green-600 ">Log out <span aria-hidden="true">&rarr;</span></a>
          @endauth
        </div>
      </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="lg:hidden hidden" id="mobile-menu" role="dialog" aria-modal="true">
      <div class="fixed inset-0 z-50 bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <a href="#" class="flex items-center">
                <svg class="h-8 w-8 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="ml-2 text-xl font-bold text-gray-900">SaveSmart</span>
            </a>
        </div>
          <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700 hover:bg-gray-100 transition-colors" id="close-menu-button">
            <span class="sr-only">Close menu</span>
            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <!-- Mobile Links -->
        <div class="mt-6 flow-root">
          <div class="-my-6 divide-y divide-gray-500/10">
            <div class="space-y-2 py-6">
              <a href="/" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50 transition-colors">Home</a>
              {{-- <a href="/books" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50 transition-colors">Books</a> --}}
              @guest
              <a href="/login" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold text-gray-900 hover:bg-gray-50 transition-colors">Log in</a>
              <a href="/register" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold text-gray-900 hover:bg-gray-50 transition-colors">Register</a>
              @endguest
              @auth
              <a href="{{route('profiles.index')}}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold text-gray-900 hover:bg-gray-50 transition-colors">Profiles</a>
              <a href="/logout" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold text-gray-900 hover:bg-gray-50 transition-colors">Log out</a>
              @endauth
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</div>
  <script>
    // Mobile menu functionality
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const closeMenuButton = document.getElementById('close-menu-button');
  
    mobileMenuButton.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  
    closeMenuButton.addEventListener('click', () => {
      mobileMenu.classList.add('hidden');
    });
  </script>