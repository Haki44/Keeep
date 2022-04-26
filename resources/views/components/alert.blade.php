@props(['type' => null])

@if ($type === 'danger')
    <div class="mx-auto mt-4 px-2 max-w-7xl sm:px-6 lg:px-8">
        <div id="alert-1" class="flex items-center p-4 mb-4 red rounded-lg" role="alert">
            <div class="text-sm text-white w-10/12">
                {{ session()->get('danger') }}
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 text-white p-1.5 inline-flex h-8 w-2/12 justify-end" data-collapse-toggle="alert-1" aria-label="Close">
                <span class="sr-only">Fermer</span>
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414   10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd">
                    </path>
                </svg>
            </button>
        </div>
    </div>
@elseif ($type === 'success')
    <div class="mx-auto mt-4 px-2 max-w-7xl sm:px-6 lg:px-8">
        <div id="alert-1" class="flex items-center p-4 mb-4 green rounded-lg" role="alert">
            <div class="text-sm text-white w-10/12">
                {{ session()->get('success') }}
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 text-white p-1.5 hover:bg-green-200 inline-flex h-8 w-2/12 justify-end" data-collapse-toggle="alert-1" aria-label="Close">
                <span class="sr-only">Fermer</span>
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414   10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd">
                    </path>
                </svg>
            </button>
        </div>
    </div>
@endif