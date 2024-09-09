<nav class="bg-white dark:bg-gray-800 antialiased shadow">
  <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0 py-4">
    <div class="flex items-center justify-between">
      
      <!-- Logo and Navigation Links -->
      <div class="flex items-center space-x-8">
        <div class="shrink-0">
          <a href="{{ route('home.index') }}" title="" class="">
            <img class="block w-auto h-8 dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/logo-full.svg" alt="">
            <img class="hidden w-auto h-8 dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/logo-full-dark.svg" alt="">
          </a>
        </div>

        <ul class="flex items-center justify-start gap-6 md:gap-8 py-3 sm:justify-center">
          <li>
            <a href="#" title="" class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
              Home
            </a>
          </li>
          <li class="shrink-0">
            <a href="#" title="" class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
              Best Sellers
            </a>
          </li>
          <li class="shrink-0">
            <a href="#" title="" class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
              Gift Ideas
            </a>
          </li>
          <li class="shrink-0">
            <a href="#" title="" class="text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
              Today's Deals
            </a>
          </li>
          <li class="shrink-0">
            <a href="#" title="" class="text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
              Sell
            </a>
          </li>
        </ul>
      </div>

      <!-- Search Bar and Account Dropdown -->
      <div class="flex items-center lg:space-x-2">
        
        <!-- Search Bar -->
        <form action="{{ route('dashboard.index') }}" method="GET" class="relative flex">
          <input 
              type="text"
              name="search"
              class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500" 
              placeholder="Search products..."
              value="{{ request('search') }}">
              
              @if(is_array(request('categories')))
            @foreach(request('categories') as $categoryId)
              <input type="hidden" name="categories[]" value="{{ $categoryId }}">
            @endforeach
          @endif

          <input type="hidden" name="sort" value="{{ request('sort') }}"> <!-- Keep sorting option -->
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <!-- Search Icon -->
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 text-gray-500">
                  <path d="M10.035,18.069a7.981,7.981,0,0,0,3.938-1.035l3.332,3.332a2.164,2.164,0,0,0,3.061-3.061l-3.332-3.332A8.032,8.032,0,0,0,4.354,4.354a8.034,8.034,0,0,0,5.681,13.715ZM5.768,5.768A6.033,6.033,0,1,1,4,10.035,5.989,5.989,0,0,1,5.768,5.768Z"/>
              </svg>
          </div>
        </form>

        <!-- Cart Icon -->
        <button id="myCartDropdownButton1" data-dropdown-toggle="myCartDropdown1" type="button" class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium leading-none text-gray-900 dark:text-white">
          <span class="sr-only">Cart</span>
          <svg class="w-5 h-5 lg:me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
          </svg> 
          <span class="hidden sm:flex">My Cart</span>
          <svg class="hidden sm:flex w-4 h-4 text-gray-900 dark:text-white ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
          </svg>              
        </button>

        <div id="myCartDropdown1" class="hidden z-10 mx-auto max-w-sm space-y-4 overflow-hidden rounded-lg bg-white p-4 antialiased shadow-lg dark:bg-gray-800">
          <!-- Cart dropdown content here -->
        </div>

        <!-- Account Dropdown -->
        <button id="userDropdownButton1" data-dropdown-toggle="userDropdown1" type="button" class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium leading-none text-gray-900 dark:text-white">
          <svg class="w-5 h-5 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
          </svg>              
          Account
          <svg class="w-4 h-4 text-gray-900 dark:text-white ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
          </svg> 
        </button>

        <div id="userDropdown1" class="hidden z-10 w-56 divide-y divide-gray-100 overflow-hidden overflow-y-auto rounded-lg bg-white antialiased shadow dark:divide-gray-600 dark:bg-gray-700">
          <ul class="p-2 text-start text-sm font-medium text-gray-900 dark:text-white">
            <li><a href="{{ route('profile.edit') }}" title="" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"> My Account </a></li>
            <li><a href="#" title="" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"> My Orders </a></li>
            <li><a href="#" title="" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"> Settings </a></li>
            <li>
              <form method="POST" action="{{ route('logout') }}" class="inline-flex w-full">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 rounded-md text-sm hover:bg-gray-100 dark:hover:bg-gray-600">Logout</button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div id="ecommerce-navbar-menu-1" class="bg-gray-50 dark:bg-gray-700 dark:border-gray-600 border border-gray-200 rounded-lg py-3 hidden px-4 mt-4">
      <ul class="text-gray-900 dark:text-white text-sm font-medium dark:text-white space-y-3">
        <li>
          <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Home</a>
        </li>
        <li>
          <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Best Sellers</a>
        </li>
        <li>
          <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Gift Ideas</a>
        </li>
        <li>
          <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Games</a>
        </li>
        <li>
          <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Electronics</a>
        </li>
        <li>
          <a href="#" class="hover:text-primary-700 dark:hover:text-primary-500">Home & Garden</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
