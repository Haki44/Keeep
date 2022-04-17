@props(['color' => null, 'type' => null, 'route' => null, 'price' => null])

@if ($type == "submit")
    <button 
        type='submit' 
        class='w-72 h-14 md:w-60 text-white @if($color == "purple") bg-purple-900 @else bg-yellowkeeep @endif text-2xl border-2 border-white hover:border-purple-900 hover:bg-white hover:text-purple-900 active:bg-white focus:border-purple-900 disabled:opacity-25 transition ease-in-out duration-150'>
        {{ $slot }}
    </button> 
@elseif($type =="click") 
    <a @click="open = !open" class='min-w-72 h-14 md:min-w-60 px-4 text-white @if($color === "purple") bg-purple-900 @else bg-yellowkeeep @endif text-2xl border-2 border-white hover:border-purple-900 hover:bg-white hover:text-purple-900 active:bg-white focus:border-purple-900 disabled:opacity-25 transition ease-in-out duration-150 flex justify-center items-center cursor-pointer'>Acheter ( {{ $price }} kips </a>

@else
    <a href="{{$route}}" class='px-4 min-w-72 h-14 md:min-w-60 text-white @if($color === "purple") bg-purple-900 @else bg-yellowkeeep @endif text-2xl border-2 border-white hover:border-purple-900 hover:bg-white hover:text-purple-900 active:bg-white focus:border-purple-900 disabled:opacity-25 transition ease-in-out duration-150 flex justify-center items-center'>
        {{ $slot }}
    </a>
@endif
