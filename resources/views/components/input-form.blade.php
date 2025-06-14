@props([
    'name' => '',
    'label' => '',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'disabled' => false,
])

<div class="w-full">
    @if (!empty($label))
        <label for="{{ $name }}" class="block text-sm text-gray-500 dark:text-gray-500 mb-1">
            {{ $label }}
        </label>
    @endif
    <input {{ $attributes -> merge(['class' =>
            'block w-full px-3 py-2 border border-gray-500 focus:border-primary rounded-md outline-none ring-0 focus:ring-0 bg-gray-100 dark:bg-gray-700 dark:text-white'
        ]) }}
        type="{{ $type }}" name="{{ $name }}"
        id="{{ $name }}" value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $disabled ? 'disabled' : '' }}
    >
</div>