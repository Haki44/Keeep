@props(['user' => null])

@if ($user)
    <div class="conversation-single flex flex-row-reverse justify-end items-center w-full p-5 md:mt-2 md:hidden">
        @if ($user->avatar)
            <img :src="$user->avatar" alt="My profile" class="order-1 w-11 h-11 rounded-full mr-5">
        @else
            <div class="order-1 w-9 h-9 rounded-full orange mr-5"></div>
        @endif
        <h3 class="text-xl">{{ $user->name }} {{ $user->firstname }}</h3>
    </div>
@endif