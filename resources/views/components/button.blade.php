@props(['color' => null, 'type' => null, 'route' => null, 'price' => null])

@if ($type == "submit")
    <button 
        type='submit' 
        class='w-72 h-14 md:w-60 text-white @if($color === "purple") bg-purple-900 @else bg-yellowkeeep @endif text-2xl border-2 border-white hover:border-purple-900 hover:bg-white hover:text-purple-900 active:bg-white focus:border-purple-900 disabled:opacity-25 transition ease-in-out duration-150'>
        {{ $slot }}
    </button> 
@elseif($type="click") 
    <a @click="open = !open" class='w-72 h-14 md:w-60 text-white @if($color === "purple") bg-purple-900 @else bg-yellowkeeep @endif text-2xl border-2 border-white hover:border-purple-900 hover:bg-white hover:text-purple-900 active:bg-white focus:border-purple-900 disabled:opacity-25 transition ease-in-out duration-150'>Acheter ( {{ $price }} kips </a>

@else 
    <a href="{{$route}}" class='w-72 h-14 md:w-60 text-white @if($color === "purple") bg-purple-900 @else bg-yellowkeeep @endif text-2xl border-2 border-white hover:border-purple-900 hover:bg-white hover:text-purple-900 active:bg-white focus:border-purple-900 disabled:opacity-25 transition ease-in-out duration-150'>
        {{ $slot }}
    </a>
@endif
