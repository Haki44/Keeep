{{-- <div class="flex justify-between" x-data="{ search: false }">
    <button class="mx-1" @click="search = true" type="button">
        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.5 1.5C5.81055 1.5 2 5.31055 2 10C2 14.6895 5.81055 18.5 10.5 18.5C12.3555 18.5 14.0703 17.9023 15.4688 16.8906L22.0469 23.4531L23.4531 22.0469L16.9531 15.5312C18.2305 14.043 19 12.1113 19 10C19 5.31055 15.1895 1.5 10.5 1.5ZM10.5 2.5C14.6484 2.5 18 5.85156 18 10C18 14.1484 14.6484 17.5 10.5 17.5C6.35156 17.5 3 14.1484 3 10C3 5.85156 6.35156 2.5 10.5 2.5Z" fill="#341074"/>
        </svg>    
    </button>
    <div x-show="search" class="">
        <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
            <!-- Modal content -->
            <div class="bg-white rounded-lg shadow relative">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-5 border-b rounded-t">
                    <h3 class="text-xl lg:text-2xl font-semibold">
                        Suppression
                    </h3>
                    <button @click="search = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
         --}}


         
<div class="flex justify-end h-screen w-screen">
    <div x-data="{ dropdownOpen: true }" class="absolute right-0">
        <button @click="dropdownOpen = !dropdownOpen" class="absolute right-12 top-3 z-10 block bg-white p-2 focus:outline-none">
            <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.5 1.5C5.81055 1.5 2 5.31055 2 10C2 14.6895 5.81055 18.5 10.5 18.5C12.3555 18.5 14.0703 17.9023 15.4688 16.8906L22.0469 23.4531L23.4531 22.0469L16.9531 15.5312C18.2305 14.043 19 12.1113 19 10C19 5.31055 15.1895 1.5 10.5 1.5ZM10.5 2.5C14.6484 2.5 18 5.85156 18 10C18 14.1484 14.6484 17.5 10.5 17.5C6.35156 17.5 3 14.1484 3 10C3 5.85156 6.35156 2.5 10.5 2.5Z" fill="#341074"/>
            </svg> 
        </button>
        <div x-show="dropdownOpen" class="right-0 mt-2 bg-white shadow-lg overflow-hidden z-20 w-screen">
            <div class="top-16 bg-purple-900 absolute h-20 w-screen left-0 text-white text-center flex items-center justify-center text-xl pb-5">
                Que recherchez-vous ?
            </div>
            <div class="absolute flex justify-center w-screen left-0 top-28">
                <div class="py-2">
                    <input type="text" class="border-2 border-purple-900 px-4 py-2 w-80 focus:ring-purple-400 focus:border-purple-400" placeholder="Rechercher une offre..." wire:model.debounce.500ms="search">
                </div>
            </div>
        </div>
    </div>
</div>