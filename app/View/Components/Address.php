<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Address extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;
    public $inputName;
    public $labelFor;
    public $value;
    public function __construct($title, $inputName , $labelFor , $value)
    {
        $this->title = $title;
        $this->inputName = $inputName;
        $this->labelFor = $labelFor;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.address');
    }
}
