<?php

namespace App\View\Components;

use App\Models\Setting;
use Illuminate\View\Component;

class FooterSection extends Component
{
    public string $title;
    public function __construct()
    {
        $settings = Setting::first();
        $this->title = $settings->footer_text ?? "Innovative Station Limited";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.footer-section');
    }
}
