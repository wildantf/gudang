<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'p-1 inline-flex items-center bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-300 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
