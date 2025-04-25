<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LayoutApp extends Component
{
    public $titulo;
    /**
     * Create a new component instance.
     */
    public function __construct($titulo = null)
    {
        $this->titulo = $titulo;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout-app');
    }
}
