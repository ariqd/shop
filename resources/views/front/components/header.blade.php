<!--Nav-->
<nav id="header" class="w-full z-30 top-0 py-4" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-2">

        <label for="menu-toggle" class="cursor-pointer md:hidden block mt-2">
            <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20">
                <title>menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
            </svg>
        </label>
        <input class="hidden" type="checkbox" id="menu-toggle" @click="open = !open" />

        <div class="hidden md:flex items-center md:w-1/3 w-full order-3 md:order-1" id="menu">
            <nav>
                <ul class="md:flex items-center justify-between text-base text-gray-700 md:pt-0">
                    @forelse ($headerCategories as $categories)
                        <li><a class="inline-block no-underline hover:text-black hover:underline py-2 px-4" href="{{ url('/'.$categories->slug) }}">{{ $categories->name }}</a></li>
                    @empty
                        <li><a class="inline-block no-underline hover:text-black hover:underline py-2 px-4" href="#">No Category</a></li>
                    @endforelse
                    {{-- <li><a class="inline-block no-underline hover:text-black hover:underline py-2 px-4" href="#">No Category</a></li> --}}
                </ul>
            </nav>
        </div>

        <div class="order-1 md:order-2 w-1/3">
            <a class="flex items-center justify-start md:justify-center tracking-widest no-underline hover:no-underline font-bold text-gray-800 hover:text-gray-700 text-2xl " href="{{ url('/') }}">
                <img src="{{ asset('img/logo2.png') }}" class="md:w-1/5 w-2/3 md:h-8 " alt="logo-light" />
            </a>
        </div>

        <div class="order-2 md:order-3 flex items-center w-1/3 justify-end text-gray-700" id="nav-content">
            
            <a class="pr-4 md:pr-6 flex no-underline hover:text-black" href="{{ route('front.cart.index') }}">
                <svg class="fill-current text-gray-800 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M5,22h14c1.103,0,2-0.897,2-2V9c0-0.553-0.447-1-1-1h-3V7c0-2.757-2.243-5-5-5S7,4.243,7,7v1H4C3.447,8,3,8.447,3,9v11 C3,21.103,3.897,22,5,22z M9,7c0-1.654,1.346-3,3-3s3,1.346,3,3v1H9V7z M5,10h2v2h2v-2h6v2h2v-2h2l0.002,10H5V10z" />
                </svg>
                <span>
                    ({{ Cart::count() }})
                </span>
            </a>

            @if (Route::has('login'))
                @auth
                    @if (auth()->user()->role == App\User::CUSTOMER)
                    <div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">

                        <div class="flex no-underline hover:text-black cursor-pointer" @click="open = ! open">
                            <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <circle fill="none" cx="12" cy="7" r="3" />
                                <path d="M12 2C9.243 2 7 4.243 7 7s2.243 5 5 5 5-2.243 5-5S14.757 2 12 2zM12 10c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3S13.654 10 12 10zM21 21v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h2v-1c0-2.757 2.243-5 5-5h4c2.757 0 5 2.243 5 5v1H21z" />
                            </svg>                            
                            <span class="truncate w-32 hidden md:block">
                                {{ auth()->user()->name }}
                            </span>
                        </div>
                    
                        <div x-show="open"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right right-0"
                                style="display: none;"
                                @click="open = false">
                            <div class="rounded-md shadow-xs py-1 bg-white">
                                <nav>
                                    <ul class="text-base">
                                        <li>
                                            <a class="w-full inline-block no-underline hover:text-black hover:underline py-2 px-4" href="{{ route('front.transactions.index') }}">
                                                Transaksi
                                            </a>
                                        </li>
                                        <li>
                                            <a class="w-full inline-block no-underline hover:text-black hover:underline py-2 px-4" href="{{ route('front.address.index') }}">
                                                Alamat
                                            </a>
                                        </li>
                                        <li>
                                            <div class="border-t border-gray-200"></div>
                                        </li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                            
                                                <a class="w-full inline-block no-underline text-red-800 hover:text-red-700 hover:underline py-2 px-4"
                                                    href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                                >
                                                    {{ __('Logout') }}
                                                </a>
                                            </form>
                                            {{-- <a  href="{{ url('/transactions') }}">
                                                Log Out
                                            </a> --}}
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>                
             
                        {{-- <a href="{{ url('/dashboard') }}" class="text-sm underline">All Transactions</a> --}}
                    @else
                    {{-- <a class="inline-block no-underline hover:text-black hover:underline py-2 px-3" href="{{ route('login') }}">Login</a> --}}

                        <a href="{{ url('admin/dashboard') }}" class="text-sm hover:text-gray-800 underline">Dashboard</a>
                    @endif
                @else
                    {{-- <a href="{{ route('login') }}" class="text-sm underline">Login</a> --}}
                    <a class="hidden md:inline-block no-underline hover:text-black hover:underline py-2 px-3" href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a class="hidden md:inline-block no-underline hover:text-black hover:underline py-2 px-3" href="{{ route('register') }}">Register</a>
                        {{-- <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a> --}}
                    @endif
                @endif
            @endif            
        </div>
    </div>

    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-4"
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
    >
        <div class="w-full" id="menu">
            <nav>
                <ul class="md:flex items-center justify-between divide-y divide-gray-300 text-base text-gray-700 pt-4">
                    @forelse ($headerCategories as $categories)
                        <li><a class="w-full inline-block no-underline hover:bg-gray-100 hover:text-black py-4 px-6" href="{{ url('/'.$categories->slug) }}">{{ $categories->name }}</a></li>
                    @empty
                        <li><a class="w-full inline-block no-underline hover:text-black py-2 px-6" href="#">No Category</a></li>
                    @endforelse
                    {{-- <li><a class="w-full inline-block no-underline hover:text-black py-2 px-6" href="#">No Category</a></li> --}}
                </ul>
            </nav>
            <nav>
                <ul class="md:flex items-center justify-between text-base text-gray-700 pt-4 divide-y divide-gray-300">
                    @auth
                @if (auth()->user()->role == App\User::CUSTOMER)
                    @else
                    @endif
                        <li><a class="w-full inline-block no-underline hover:bg-gray-100 hover:text-black py-4 px-6" href="{{ url('/transactions') }}">{{ auth()->user()->name }}</a></li>
                    @else
                        <li><a class="w-full inline-block no-underline hover:bg-gray-100 hover:text-black py-4 px-6" href="{{ url('/login') }}">Login</a></li>
                        <li><a class="w-full inline-block no-underline hover:bg-gray-100 hover:text-black py-4 px-6" href="{{ url('/register') }}">Register</a></li>
                    @endauth
                    
                    {{-- <li><a class="w-full inline-block no-underline hover:text-black py-2 px-6" href="#">No Category</a></li> --}}
                </ul>
            </nav>
        </div>
    </div>
</nav>