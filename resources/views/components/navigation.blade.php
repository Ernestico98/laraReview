<nav class="bg-white border-b-2">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-[100px] items-center justify-between">

        <div class="flex-shrink-0">
            <img src="{{asset('img/logo.png')}}" class="w-20">
        </div>

        <div class="hidden md:block">
            <div class="flex items-baseline space-x-4">
                @foreach ($menu as $key => $item)
                <a href="{{$item['url']}}" class="
                    @if ($item['active'])
                        bg-gray-600 text-white
                    @else
                        text-black hover:bg-gray-400 hover:text-white
                    @endif
                            px-3 py-2 rounded-md text-base font-semibold" aria-current="page">{{$item['title']}}</a>
                @endforeach
            </div>
        </div>

        <div class="w-40 p-2 flex flex-row justify-center space-x-2">
            @auth
            <div class="hover:font-bold">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
            @endauth

            @guest
                <div class="hover:font-bold basis-1/2 text-center">
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
