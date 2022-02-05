<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DashboardCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;
    public $value;
    public $cssclass;
    public $svg;


    public function __construct($title, $value, $cssclass, $svg)
    {
        $this->title=$title;
        $this->value= $value;
        $this->cssclass= $cssclass;
        $this->svg= $svg;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard-card');
    }
}
