@props(['link'])

<a href='/{{$link}}' {{ $attributes->merge([
    'type' => 'submit', 
    'class' => 'mx-auto m-5 flex justify-center items-center w-72 h-14 md:w-60 text-purple-900 bg-white text-2xl border-2 border-white hover:border-white hover:text-white hover:bg-transparent focus:border-white focus:bg-opacity-25 focus:text-white disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</a>
