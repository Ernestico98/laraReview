<x-site-layout text="Welcome to LaraRe!">

    <!-- Icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/LineIcons.2.0.css')}}">
    <!-- Animate -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/animate.css')}}">
    <!-- Tiny Slider  -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/tiny-slider.css')}}">

    <!-- Hero Area Start -->
    <section id="hero-area" class="bg-blue-50 -m-4 pt-32 pb-10">
        <div class="container">
          <div class="flex justify-between">
            <div class="w-full text-center">

                @auth
                    <h2 class="text-4xl font-bold leading-snug text-gray-700 mb-10 wow fadeInUp" data-wow-delay="1s">
                        Go check our places and reviews <br>
                        <br class="hidden lg:block">
                        Make the best choice for your next destination </br>
                    </h2>

                    <div class="text-center h-20 w-40 mx-auto pt-6 bg-blue-400 rounded-full text-xl text-white" >
                        <a class="my-auto" href="{{route('places.index')}}"
                        rel="nofollow"
                        class="btn">Start browsing</a>
                    </div>
                @else
                    <h2 class="text-4xl font-bold leading-snug text-gray-700 mb-10 wow fadeInUp" data-wow-delay="1s">
                        Make reviews of your favourite places <br>
                        <br class="hidden lg:block">
                        Check other's thoughts </br>
                        <br class="hidden lg:block">
                        What are you waiting for???
                    </h2>

                    <div class="text-center h-20 w-40 mx-auto pt-6 bg-blue-400 rounded-full text-xl text-white" >
                        <a class="my-auto" href="{{route('register')}}"
                        rel="nofollow"
                        class="btn">Register Now</a>
                    </div>
                @endauth

              <div class="text-center wow fadeInUp" data-wow-delay="1.6s">
                <img class="img-fluid mx-auto" src="{{asset('img/hero.svg')}}" alt="">
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Hero Area End -->

</x-site-layout>
