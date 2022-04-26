        
<div class="flex justify-end h-20 w-screen relative">
    <div class="">
        {{-- <div x-show="dropdownOpen" class="right-0 mt-2 bg-white shadow-lg overflow-hidden w-screen"> --}}
            <div class="top-0 bg-purple-900 absolute h-20 w-screen left-0 text-white text-center flex items-center justify-center text-xl pb-5">
                Que recherchez-vous ?
            </div>
            <div class="absolute flex justify-center w-screen left-0 top-12">
                <div class="py-2">
                    <input type="text" class="border-2 border-purple-900 px-4 py-2 w-80 focus:ring-purple-400 focus:border-purple-400" placeholder="Rechercher une offre..." wire:model.debounce.500ms="search">
                </div>
            </div>
        {{-- </div> --}}
    </div>
</div>