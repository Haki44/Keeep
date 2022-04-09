<button {{ $attributes->merge([
    'type' => 'submit', 
    'class' => 'w-72 h-14 md:w-60 text-white bg-purple-900 text-2xl border-2 border-white hover:border-purple-900 hover:bg-white hover:text-purple-900 active:bg-white focus:border-purple-900 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
