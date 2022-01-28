<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InfoUpper extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;
    public $link;

    public function __construct( $title, $link)
    {
        $this->title = $title;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.info-upper');
    }
}
