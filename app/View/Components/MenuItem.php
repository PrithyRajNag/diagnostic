<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MenuItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $sideIcon;
    public $title;
    public $link;
    public $hasSub;
    public $subMenu;
    public $permission;


    public function __construct( $sideIcon,$title, $link,$permission,  $hasSub = false, $subMenu = [] )
    {
        $this->sideIcon =$sideIcon;
        $this->title = $title;
        $this->link = $link;
        $this->hasSub = $hasSub;
        $this->subMenu = $subMenu;
        $this->permission = $permission;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.menu-item');
    }
}
