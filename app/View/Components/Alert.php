<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public  $type, $message;
    public function __construct($type, $message)
    {
        $this->message=$message;
        $this->type=$type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
