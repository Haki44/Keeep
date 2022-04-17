@props(['reply' => null, 'offer' => null])

@if ($reply && $offer)
    <div class="block md:border-none md:table-row">
        <div class="p-2 text-center md:w-2/12 md:border md:border-grey-500 md:table-cell">{{ $reply->user->firstname }} {{ $reply->user->name }}</div>
        @if ($offer->pricing !== 0)
            <div class="block p-2 text-center md:w-2/12 md:border md:border-grey-500 md:table-cell">{{ $reply->quantity }} {{ $reply->quantity > 1 ? $offer->pricing_name . 's' : $offer->pricing_name }}</div>
        @endif
        <div class="block w-full p-2 text-center md:border md:border-grey-500 md:table-cell md:w-4/12">{{ $reply->reply }}</div>

        @if ($reply->status === null)
            {{-- En FullPage --}}
            <div class="hidden w-full p-2 text-left md:block md:w-1/12 md:border md:border-grey-500 md:table-cell">
                <a href="{{route('reply.update', [$reply->id, 1])}}" class="block md:flex md:justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="#00561B">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </a>
            </div>
            <div class="hidden w-full p-2 text-left md:block md:w-1/12 md:border md:border-grey-500 md:table-cell">
                <a href="{{route('reply.update', [$reply->id, 0])}}" onclick="return confirm('Est-vous sur de refuser {{ $offer->name }} à {{ $reply->user->firstname }} ?')" class="block md:flex md:justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="#f00020">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>

        {{-- En Mobile --}}
        <div class="block w-full p-2 md:mt-2 md:hidden">
            <span class="flex my-2">
                <a href="{{route('reply.update', [$reply->id,1])}}" class="mr-4 flex w-1/2 justify-center text-white block purple focus:ring-4 focus:ring-blue-300 font-medium px-5 py-2.5 text-center">
                    Accepter
                </a>

                <a href="{{ route('reply.update', [$reply->id, 0]) }}" class="ml-4 flex w-1/2 justify-center text-white block orange focus:ring-4 focus:ring-blue-300 font-medium px-5 py-2.5 text-center" onclick="return confirm('Est-vous sur de refuser {{ $offer->name }} à {{ $reply->user->firstname }} ?')">
                    Refuser
                </a>
            </span>
        </div>

        @elseif ($reply->status === 0)

        <div class="w-full p-2 text-left md:block md:w-2/12 md:border md:border-grey-500 md:table-cell">
                Offre refusée
        </div>

        @elseif ($reply->status === 1)

        <div class="w-full p-2 text-left md:block md:w-2/12 md:border md:border-grey-500 md:table-cell">
            <a href="{{route('reply.show', $reply->id)}}" class="text-white block purple focus:ring-4 focus:ring-blue-300 font-medium px-5 py-2.5 text-center">Voir la transaction</a>
        </div>

        @endif

    </div>
@endif