<button {{ $attributes->merge([
    'type' => 'button',
    'class' =>
        'inline-flex items-center px-5 py-2 rounded-full font-semibold text-xs uppercase tracking-widest
         bg-white text-[#406f6b] border border-[#406f6b] shadow-sm
         hover:bg-[#f0f7f6]
         focus:outline-none focus:ring-2 focus:ring-[#315e5b] focus:ring-offset-2
         transition ease-in-out duration-150'
]) }}>
    {{ $slot }}
</button>
