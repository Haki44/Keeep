@props(['color' => null, 'type' => null, 'route' => null, 'price' => null])

@if ($type == "submit")
    <button
        wire:click="checkCode"
        type='submit'
        class='w-10/12 m-2 inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-purple-keeep hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-blue-800'>
        {{ $slot }}
    </button>
@elseif($type =="click")
    <a wire:click="checkCode" @click="open = !open" class='w-10/12 m-2 inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-purple-keeep hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-blue-800'>Acheter {{ $price }} kips </a>

@else
    <a wire:click="checkCode" href="{{$route}}" class='w-10/12 m-2 inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-purple-keeep hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-blue-800'>
        {{ $slot }}
    </a>
@endif
