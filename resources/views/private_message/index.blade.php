<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Messages privés avec {{ $user->firstname }} {{ strtoupper($user->name[0]) }}.
        </h2>
    </x-slot>

    <div class="max-w-4xl px-2 mx-auto mt-6 md:max-w-full sm:px-6 lg:px-8">

        <div class="p-5 overflow-hidden bg-white shadow-sm lg:p-10 sm:rounded-lg">
            <div class="flex flex-col justify-between flex-1 max-h-screen p:2 sm:p-6">
                <div class="flex justify-between py-3 border-b-2 border-gray-200 sm:items-center">
                   <div class="flex items-center space-x-4">
                      <img src="https://images.unsplash.com/photo-1549078642-b2ba4bda0cdb?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=3&amp;w=144&amp;h=144" alt="" class="w-10 h-10 rounded-full sm:w-16 sm:h-16">
                      <div class="flex flex-col leading-tight">
                         <div class="flex items-center mt-1 text-2xl">
                            <span class="mr-3 text-gray-700">{{ $user->firstname }}</span>
                         </div>
                      </div>
                   </div>
                </div>
                <div id="messages" class="flex flex-col-reverse p-3 space-y-4 overflow-y-auto scrolling-touch scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2">

                    @foreach ($private_messages as $private_message)
                        @if ($private_message->to_id == $user->id)
                            <div class="chat-message">
                                <div class="flex items-end justify-end">
                                    <div class="flex flex-col items-end order-1 max-w-xs mx-2 space-y-2 text-xs">
                                        <div><span class="inline-block px-4 py-2 text-white bg-blue-600 rounded-lg rounded-br-none ">{{ $private_message->content }}</span></div>
                                    </div>
                                    <img src="https://images.unsplash.com/photo-1590031905470-a1a1feacbb0b?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=3&amp;w=144&amp;h=144" alt="My profile" class="order-2 w-6 h-6 rounded-full">
                                </div>
                            </div>
                        @else
                            <div class="chat-message">
                                <div class="flex items-end">
                                    <div class="flex flex-col items-start order-2 max-w-xs mx-2 space-y-2 text-xs">
                                        <div><span class="inline-block px-4 py-2 text-gray-600 bg-gray-300 rounded-lg rounded-bl-none">{{ $private_message->content }}</span></div>
                                    </div>
                                    <img src="https://images.unsplash.com/photo-1549078642-b2ba4bda0cdb?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=3&amp;w=144&amp;h=144" alt="My profile" class="order-1 w-6 h-6 rounded-full">
                                </div>
                            </div>
                        @endif
                    @endforeach





                </div>
                <div class="px-4 pt-4 mb-2 border-t-2 border-gray-200 sm:mb-0">
                   <form action="" method="POST" class="relative flex">
                      <input type="text" placeholder="Saisir votre message ici" name="content" class="w-full py-3 pl-12 text-gray-600 placeholder-gray-600 bg-gray-200 rounded-full focus:outline-none focus:placeholder-gray-400">
                      <div class="absolute inset-y-0 right-0 items-center hidden sm:flex">
                         <button type="button" class="inline-flex items-center justify-center w-12 h-12 text-white transition duration-500 ease-in-out bg-blue-500 rounded-full hover:bg-blue-400 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 transform rotate-90">
                               <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                            </svg>
                         </button>
                      </div>
                   </form>
                </div>
             </div>
        </div>
    </div>
</x-app-layout>

<script>
    const el = document.getElementById('messages')
    el.scrollTop = el.scrollHeight
</script>
