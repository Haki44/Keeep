@props(['type' => 'sender', 'avatar' => null, 'pm' => null])

@if ($pm)
    <div class="chat-message">
        @if ($type === "sender")
            <div class="chat-message">
                <div class="flex items-end justify-end">
                    <div class="flex flex-col items-end order-1 max-w-xs mx-2 space-y-2 text-xs">
                        <div class="flex flex-col"><span class="inline-block px-4 py-2 text-white purple rounded-full chat-message-right z-0">{{ $pm->content }}</span><span>{{ date('H:i', strtotime($pm->created_at))}}</span></div>
                    </div>
                    @if ($avatar)
                        <img :src="$avatar" alt="My profile" class="order-2 w-11 h-11 rounded-full">
                    @else
                        <div class="order-2 w-11 h-11 rounded-full orange"></div>
                    @endif
                </div>
            </div>
        @else
            <div class="flex items-end">
                <div class="flex flex-col items-start order-2 max-w-xs mx-2 space-y-2 text-xs">
                    <div class="flex flex-col"><span class="inline-block px-4 py-2 text-white purple rounded-full chat-message-left z-0">{{ $pm->content }}</span><span class="text-right">{{ date('H:i', strtotime($pm->created_at))}}</span></div>
                </div>
                @if ($avatar)
                        <img :src="$avatar" alt="My profile" class="order-1 w-11 h-11 rounded-full">
                    @else
                        <div class="order-1 w-11 h-11 rounded-full orange"></div>
                    @endif
            </div>
        @endif
    </div>
@endif