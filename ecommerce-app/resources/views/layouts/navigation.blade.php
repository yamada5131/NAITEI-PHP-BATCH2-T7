<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('home.index') }}" class="flex-shrink-0 text-xl font-bold text-gray-800">My Shop</a>

                <!-- Search Bar -->
                <form action="{{ route('dashboard.index') }}" method="GET" class="relative ml-6">
                    <input 
                        type="text"
                        name="search"
                        class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                        placeholder="Search products...">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <!-- Search Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 text-gray-500">
                            <path d="M10.035,18.069a7.981,7.981,0,0,0,3.938-1.035l3.332,3.332a2.164,2.164,0,0,0,3.061-3.061l-3.332-3.332A8.032,8.032,0,0,0,4.354,4.354a8.034,8.034,0,0,0,5.681,13.715ZM5.768,5.768A6.033,6.033,0,1,1,4,10.035,5.989,5.989,0,0,1,5.768,5.768Z"/>
                        </svg>
                    </div>
                </form>
            </div>
            
            <div class="flex items-center space-x-6" id="cart-icon">
                <!-- Cart Icon -->
                <a href="#" class="relative text-gray-500 hover:text-gray-700" onclick="sidebarOpen()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="40.34"><g fill="#1a171b"><path d="M47.273 0h-6.544a.728.728 0 0 0-.712.58L38.63 7.219H.727a.727.727 0 0 0-.7.912l4.6 17.5c.006.021.019.037.026.059a.792.792 0 0 0 .042.094.747.747 0 0 0 .092.135.831.831 0 0 0 .065.068.626.626 0 0 0 .167.107.285.285 0 0 0 .045.029l13.106 5.145-5.754 2.184a4.382 4.382 0 1 0 .535 1.353l7.234-2.746 6.866 2.7A4.684 4.684 0 1 0 27.6 33.4l-5.39-2.113 13.613-5.164c.013-.006.021-.016.033-.021a.712.712 0 0 0 .188-.119.625.625 0 0 0 .063-.072.654.654 0 0 0 .095-.135.58.58 0 0 0 .04-.1.73.73 0 0 0 .033-.084l5.042-24.137h5.953a.728.728 0 0 0 0-1.455zM8.443 38.885a3.151 3.151 0 1 1 3.152-3.15 3.155 3.155 0 0 1-3.152 3.15zm23.1-6.3a3.151 3.151 0 1 1-3.143 3.149 3.155 3.155 0 0 1 3.148-3.152zM25.98 8.672l-.538 7.3H14.661l-.677-7.295zm-.645 8.75-.535 7.293h-9.328l-.672-7.293zM1.671 8.672h10.853l.677 7.3h-9.61zm2.3 8.75h9.362l.677 7.293H5.892zM20.2 30.5 9.175 26.17H31.6zm14.778-5.781h-8.722l.537-7.293h9.7zm1.822-8.752h-9.9l.537-7.295h10.889z"/><circle cx="8.443" cy="35.734" r=".728"/><circle cx="31.548" cy="35.734" r=".728"/></g></svg>
                    <!-- Cart item count -->
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">3</span>
                </a>
                
                <a href="{{ route('profile.edit') }}" class="text-gray-500 hover:text-gray-700">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="ml-4 text-gray-500 hover:text-gray-700">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>



