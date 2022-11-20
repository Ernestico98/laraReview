<nav class="bg-white border-b-2">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-[100px] items-center justify-between">

        <div class="flex-shrink-0">
            <a href="{{ route('home') }}" class="border-0">
                <img src="{{asset('img/logo.png')}}" class="w-20">
            </a>
        </div>

        <div class="hidden md:block">
            <div class="flex items-baseline space-x-4">
                @foreach ($menu as $key => $item)
                    @if($item['title'] == "Administration")
                        @continue
                    @endif

                    <a href="{{$item['url']}}" class="
                        @if ($item['active'])
                            bg-gray-600 text-white
                        @else
                            text-black hover:bg-gray-400 hover:text-white
                        @endif
                                px-3 py-2 rounded-lg text-base font-semibold" aria-current="page">{{$item['title']}}
                    </a>
                @endforeach

                @auth
                    @if(auth()->user()->isAdmin)
                        <button id="dropdownDefault" data-dropdown-toggle="dropdown" class="
                            @if ($menu[3]['active'])
                                bg-gray-600 text-white
                            @else
                                text-black hover:bg-gray-400 hover:text-white
                            @endif
                                    px-3 py-2 rounded-lg text-base font-semibold" aria-current="page">{{$menu[3]['title']}}
                        </button>

                        <div id="dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                                <li>
                                    <a href="{{route('users.index')}}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Users</a>
                                </li>
                                <li>
                                    <a href="{{route('complaints.index')}}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Complaints</a>
                                </li>
                            </ul>
                        </div>
                        @endif
                @endauth
            </div>



        </div>

        <div class="w-80 p-2 flex flex-row justify-center space-x-2">
            @auth
                <div class="hover:font-bold basis-1/2 text-end pr-2">
                    <a href="{{ route('users.show', auth()->user()->id) }}" >
                        {{auth()->user()->name}}
                    </a>
                </div>
                |
                <div class="hover:font-bold">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            @endauth

            @guest
                <div class="hover:font-bold basis-1/2 text-end pr-2">
                    <a href="{{ route('login') }}" >
                        Login
                    </a>
                </div>
                /
                <div class="hover:font-bold basis-1/2">
                    <a href="{{ route('register') }}" >
                        Register
                    </a>
                </div>
            @endguest
        </div>



      </div>
    </div>

</nav>
