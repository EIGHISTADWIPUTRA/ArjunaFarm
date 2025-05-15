<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FeatureCard extends Component
{
    /**
     * The feature title.
     *
     * @var string
     */
    public $title;

    /**
     * The feature description.
     *
     * @var string
     */
    public $description;

    /**
     * The feature icon.
     *
     * @var string
     */
    public $icon;

    /**
     * Create a new component instance.
     *
     * @param  string  $title
     * @param  string  $description
     * @param  string  $icon
     */
    public function __construct(string $title, string $description, string $icon)
    {
        $this->title = $title;
        $this->description = $description;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.feature-card');
    }
}
