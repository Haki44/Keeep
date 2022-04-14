<div>
    <div class="py-12">
        <div class="flex items-center justify-center">
            <div class="flex rounded mb-4 absolute top-0">
                <x-search/>
            </div>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 flex flex-wrap justify-evenly">
            @foreach ($offers as $offer)
                <x-card :offer="$offer"></x-card>
            @endforeach
        </div>
        <div>
            <div class="w-screen flex justify-center mt-5">
                {{ $offers->links() }}
            </div>
        </div>
    </div>
</div>
