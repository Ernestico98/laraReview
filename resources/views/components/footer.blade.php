<footer class="text-center bg-gray-900 text-white">

    <div class="container px-6 pt-6 mx-auto">
      <div class="flex justify-center mb-6">
        @foreach ($menu as $key => $item)
            @if($item['title'] != 'Administration')
                <a href="{{$item['url']}}" class="text-white px-3 py-2 rounded-md text-base font-semibold" aria-current="page">{{$item['title']}}</a>
            @endif
        @endforeach
      </div>
    </div>

    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2022 Copyright:
      <a class="text-whitehite" href="{{route('home')}}">LaraRe</a>
    </div>
  </footer>
