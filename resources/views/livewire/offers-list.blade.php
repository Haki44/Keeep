<div>
    <div class="py-5">
        <div class="flex items-center justify-center">
            <div class="flex rounded mb-4 top-0">
                <x-search/>
            </div>
        </div>

        <div class="flex flex-wrap max-w-6xl mx-auto sm:px-6 lg:px-8 justify-evenly">
            @foreach ($offers as $offer)
                <x-card :offer="$offer"></x-card>
            @endforeach
        </div>
        <div>
            <div class="flex justify-center w-screen mt-5">
                {{ $offers->links() }}
            </div>
        </div>
    </div>
</div>
