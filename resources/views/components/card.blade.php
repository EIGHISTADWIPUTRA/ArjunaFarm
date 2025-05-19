@props([
    'xp' => 'p-4',
    'rounded' => 'rounded-lg',
])

<div {{ $attributes->merge(['class' =>
        'flex flex-col bg-white text-black dark:bg-gray-800 dark:text-white shadow-md ' .
        $xp . ' ' . $rounded
    ]) }}>
    {{ $slot }}
</div>