@props(['model' => null])

<div class="relative flex justify-end w-screen h-20">
    <div class="">
        {{-- <div x-show="dropdownOpen" class="right-0 w-screen mt-2 overflow-hidden bg-white shadow-lg"> --}}
            <div class="absolute top-0 left-0 flex items-center justify-center w-screen h-20 pb-5 text-xl text-center text-white bg-purple-900">
                Que recherchez-vous ?
            </div>
            <div class="absolute left-0 flex justify-center w-screen top-12">
                <div class="py-2">
                    <input type="text" class="px-4 py-2 border-2 border-purple-900 w-80 focus:ring-purple-400 focus:border-purple-400" placeholder="Rechercher une offre..." wire:model.debounce.500ms={{ $model }}>
                </div>
            </div>
        {{-- </div> --}}
    </div>
</div>