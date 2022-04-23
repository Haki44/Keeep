

<div class="h-full d-flex justify-content-center border-bottom-1 relative ml-4" x-data="{ open:false}">
    <button class="w-5 h-5 mr-3 mt-3 absolute top-22 d-flex" @click="open = !open">

        <div class="w-7 h-7 bg-red-600 d-flex text-white absolute rounded-full mb-3 -left-1 -top-1">{{$notification_count}}</div>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-11 w-11 right-5 top-0" viewBox="0 0 20 20">
            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
        </svg>
    </button>
    <div x-show="open" class="absolute h-64 top-20 -right-5 w-64">
        <ul class="flex w-[100%] bg-white flex-col h-auto">
            @foreach($replies as $reply)


                @if (isset($reply->status))
                    @if ($reply->status === 1)
                        <li class="w-[100%] bg-white flex flex-col border-b-2 border-gray-100 hover:bg-gray-100 p-5 cursor-pointer">
                            <a href="{{ route('offer.show', ['offer' => $reply->offer_id]) }}">
                                <strong> Votre offre a été acceptée</strong>
                            </a>
                        </li>
                    @endif
                    @if (!is_null($reply->deleted_at))
                        <li class="w-[100%] bg-white flex flex-col border-b-2 border-gray-100 hover:bg-gray-100 p-5 cursor-pointer">
                            <a href="{{ route('offer.show', ['offer' => $reply->offer_id]) }}">
                                <strong> Votre offre a été refusée</strong>
                            </a>
                        </li>
                    @endif
                @endif
            @endforeach
            @foreach($privates_messages as $private_message)
                @if (is_null($private_message->is_readed))
                    <li class="w-[100%] bg-white flex flex-col border-b-2 border-gray-100 hover:bg-gray-100 p-5 cursor-pointer" wire:click.prevent="switch_to_readed({{ $private_message->id }})">
                        <a href="{{ route('private_message.index', ['offer' => $reply->offer_id, 'user' => 4]) }}">
                            <strong>Nouveau message</strong><br>{{ substr($private_message->content, 0, 50) . ' ...'}}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>


</div>

