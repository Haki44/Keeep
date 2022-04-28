@props(['reply' => null])

@if ($reply)
    <div class="block md:border-none md:table-row">
        <div class="block p-2 text-center md:w-2/12 md:border md:border-grey-500 md:table-cell">{{ $reply->user->firstname }}{{ $reply->user->name }}</div>
        <div class="block w-full p-2 text-center md:border md:border-grey-500 md:table-cell md:w-6/12">{{ $reply->reply }}</div>
        <div class="w-full p-2 text-center md:block md:w-2/12 md:border md:border-grey-500 md:table-cell">
            <a href="{{route('reply.show', $reply->id)}}" class="text-white block purple focus:ring-4 focus:ring-blue-300 font-medium px-5 py-2.5 text-center">Voir la transaction</a>
        </div>
    </div>
@endif