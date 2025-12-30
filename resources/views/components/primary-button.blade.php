<button {{ $attributes->merge([
    'type' => 'submit',
    'class' =>
        'inline-flex items-center px-5 py-2 rounded-full font-semibold text-xs uppercase tracking-widest
         bg-[#406f6b] text-white shadow-sm
         hover:bg-[#254846]
         focus:outline-none focus:ring-2 focus:ring-[#315e5b] focus:ring-offset-2
         transition ease-in-out duration-150'
]) }}>
    {{ $slot }}
</button>
