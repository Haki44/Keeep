<div class="h-full d-flex justify-content-center border-bottom-1 relative ml-4" x-data="{ open:true}">
    <button class="w-5 h-5 mr-3 mt-3 absolute top-22 d-flex" @click="open = !open">
        <div class="w-7 h-7 bg-red-600 d-flex text-white absolute rounded-full mb-3 -left-1 -top-1">{{$notifications->count()}}</div>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-11 w-11 right-5 top-0" viewBox="0 0 20 20">
            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
        </svg>
    </button>
    <ul x-show="open" class="absolute w-64 top-20 bg-white d-flex">
        @foreach($notifications as $notification)
            @if(isset($notification->is_accepted))
                @if($notification->is_accepted === 1)
                    <li>
                        <a href="{{ route('offer.show', ['offer' => $notification->offer_id]) }}" class="w-64 bg-white border-b-2 border-gray-100 hover:bg-gray-100 p-5 cursor-pointer">
                            <strong> Votre offre a été acceptée</strong>
                        </a>
                    </li>
                @endif
                @if(!is_null($notification->deleted_at))
                        <li>
                            <a href="{{ route('offer.show', ['offer' => $notification->offer_id]) }}" class="w-64 bg-white border-b-2 border-gray-100 hover:bg-gray-100 p-5 cursor-pointer">
                                <strong> Votre offre a été refusée</strong>
                            </a>
                        </li>
                @endif

            @elseif(isset($notification->from_id))
                <li class="w-64 bg-white border-b-2 border-gray-100 hover:bg-gray-100 p-5 cursor-pointer">
                    <a href="">
                        <strong>Nouveau message</strong><br>{{ substr($notification->content, 0, 50) . ' ...'}}
                    </a>
                </li>
            @endif
            @endforeach
    </ul>
</div>
