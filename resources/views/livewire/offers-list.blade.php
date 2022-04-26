<div>
    <div class="py-5">
        <div class="flex items-center justify-center">
            <div class="top-0 flex mb-4 rounded">
                <x-search model='search' />
            </div>
        </div>

        <div class="flex flex-wrap max-w-6xl mx-auto sm:px-6 lg:px-8 justify-evenly">
            @foreach ($offers as $offer)
                <x-card :offer="$offer" />
            @endforeach
        </div>
        <div>
            <div class="flex justify-center w-screen mt-5">
                {{ $offers->links() }}
            </div>
        </div>
    </div>
</div>
