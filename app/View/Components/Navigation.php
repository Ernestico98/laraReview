<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Navigation extends Component
{
    public array $menu;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->menu = config('laraRe.menu');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        foreach ($this->menu as $key => $item) {
            $this->menu[$key]['active'] = ($item['title'] != 'Home') ? Str::contains(request()->getRequestUri(), $item['url']) : request()->getRequestUri() == '/';
        }

        return view('components.navigation');
    }
}
