<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BookingSteps extends Component
{
    /**
     * The current step.
     *
     * @var int
     */
    public $currentStep;

    /**
     * Create a new component instance.
     *
     * @param  int  $currentStep
     */
    public function __construct(int $currentStep = 1)
    {
        $this->currentStep = $currentStep;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.booking-steps');
    }
}
