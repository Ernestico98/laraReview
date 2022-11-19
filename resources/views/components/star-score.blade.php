<div class="flex flex-row">
    @for ($i = 1; $i <= 5; $i++)
        @if($i <= $score)
            <x-filled-star/>
        @else
            <x-outlined-star/>
        @endif
    @endfor
</div>
