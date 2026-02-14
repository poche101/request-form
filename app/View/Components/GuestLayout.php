<?php

namespace App\View\Components; // IMPORTANT: Do not remove this

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
     * @param string $title Optional page title
     */
    public function __construct(
        public string $title = 'IT Support Portal'
    ) {}

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.guest');
    }
}
