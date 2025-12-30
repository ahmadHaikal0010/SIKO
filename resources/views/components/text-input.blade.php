@props(['disabled' => false])

<input
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
        'class' =>
            'border-gray-300 rounded-xl shadow-sm w-full
             focus:border-[#315e5b] focus:ring-[#315e5b]
             bg-white text-gray-900'
    ]) !!}
/>
