@props([
    'href' => '#',
    'xw' => 'w-full',
    'xh' => 'h-12',
    'xpx' => '',
    'xpy' => '', 
    'xbg' => 'bg-primary',
    'xtxt' => 'text-white',
    'weight' => 'font-bold',
    'rounded' => 'rounded-full',
    'disabled' => false,
])

<a href="{{ $href }}"
    {{ $attributes->merge(['class' =>
        'flex items-center justify-center ' .
        $xw . ' ' . $xh . ' ' . $xpx . ' ' . $xpy . ' ' . $xbg . ' ' . $xtxt . ' ' . $weight . ' ' . $rounded
    ]) }}
    @if ($disabled) disabled @endif
>
    {{ $slot }}
</a>