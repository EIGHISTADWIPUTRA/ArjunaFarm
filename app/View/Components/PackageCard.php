<?php

namespace App\View\Components;

use App\Models\Package;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PackageCard extends Component
{
    /**
     * The package instance.
     *
     * @var \App\Models\Package
     */
    public $package;

    /**
     * Show detailed pricing information.
     *
     * @var bool
     */
    public $showPricing;

    /**
     * Create a new component instance.
     *
     * @param  \App\Models\Package  $package
     * @param  bool  $showPricing
     */
    public function __construct(Package $package, bool $showPricing = true)
    {
        $this->package = $package;
        $this->showPricing = $showPricing;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.package-card');
    }
}
