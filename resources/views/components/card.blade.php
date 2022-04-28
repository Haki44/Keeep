@props(['offer' => null])

<div class="w-full max-w-sm m-3 overflow-hidden rounded-lg shadow-lg">
  @if ($offer)
    @if ($offer->img != null)
    <a href="{{ route('offer.show', $offer->id) }}" class="relative grid items-center justify-items-center">
      <p class="absolute z-10 text-xl uppercase">{{ $offer->name }}</p>
      <div class="absolute block w-full h-full bg-purple-400 opacity-50"></div>
      <img class="object-cover w-full opacity-50 max-h-32" src="{{Storage::url($offer->img)}}" alt="{{ $offer->name }}"/>
      <hr class="absolute w-3.5 h-3.5 @if (date_format(new DateTime($offer->offer_day), 'Y-m-d') >= date_format(new DateTime(), 'Y-m-d')) bg-yellowkeeep @else bg-green-500 @endif rounded-full top-5 right-5"/>
    </a>  
    @else
    <a href="{{ route('offer.show', $offer->id) }}" class="relative flex items-center justify-center block h-32 text-center bg-purple-100">
      <p class="text-xl uppercase">{{ $offer->name }}</p>
      <hr class="absolute w-3.5 h-3.5 @if (date_format(new DateTime($offer->offer_day), 'Y-m-d') >= date_format(new DateTime(), 'Y-m-d')) bg-yellowkeeep @else bg-green-500 @endif rounded-full top-5 right-5"/>
    </a>  
    @endif  
    <div class="px-6 py-4 h-14">
      <h6 class="flex justify-between font-bold"> 
        <div class="flex justify-start">
          <div class="mr-2">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle r="11" transform="matrix(-1 0 0 1 12 12)" fill="#5F4EAC" stroke="#F5B276" stroke-width="2"/>
              <path d="M10.8276 6V18H8V6H10.8276ZM17.6897 6L13.8793 11.3853L18 18H14.7241L10.9138 11.5931L14.7069 6H17.6897Z" fill="#F5B276"/>
            </svg>
          </div>
          {{ $offer->price }} kips @if ($offer->pricing !== 0)/ {{ $offer->pricing_name }}@endif
        </div>
        @can('manage-offer', $offer)
          <div class="flex justify-between" x-data="{ open: false }">
            <a class="z-10 mx-1" href="{{ route('offer.edit', $offer->id) }}">
              <svg class="stroke-yellow-300" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.232 5.232L18.768 8.768L15.232 5.232ZM16.732 3.732C17.2009 3.2631 17.8369 2.99967 18.5 2.99967C19.1631 2.99967 19.7991 3.2631 20.268 3.732C20.7369 4.2009 21.0003 4.83687 21.0003 5.5C21.0003 6.16313 20.7369 6.7991 20.268 7.268L6.5 21.036H3V17.464L16.732 3.732V3.732Z" stroke="#F5B276" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </a>
            <button class="z-10 mx-1" x-on:click="open = {{ $offer->id }}" type="button">
              <svg class="stroke-yellow-300" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 7H20M19 7L18.133 19.142C18.0971 19.6466 17.8713 20.1188 17.5011 20.4636C17.1309 20.8083 16.6439 21 16.138 21H7.862C7.35614 21 6.86907 20.8083 6.49889 20.4636C6.1287 20.1188 5.90292 19.6466 5.867 19.142L5 7H19ZM10 11V17V11ZM14 11V17V11ZM15 7V4C15 3.73478 14.8946 3.48043 14.7071 3.29289C14.5196 3.10536 14.2652 3 14 3H10C9.73478 3 9.48043 3.10536 9.29289 3.29289C9.10536 3.48043 9 3.73478 9 4V7H15Z" stroke="#F5B276" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </button>
            <div x-show="open == {{ $offer->id }}" class="fixed left-0 right-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto bg-black bg-opacity-25 h-modal md:h-full top-4 md:inset-0">
              <div class="relative w-full h-full max-w-2xl px-4 md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                  <!-- Modal header -->
                  <div class="flex items-start justify-between p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold lg:text-2xl">
                      Suppression
                    </h3>
                    <button x-on:click="open{{ $offer->id }} = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                  </div>
                  <!-- Modal body -->
                  <div class="p-6 space-y-6">
                    <p>Voulez-vous vraiment supprimer l'offre "{{ $offer->name }}" ?</p>
                  </div>
                  <!-- Modal footer -->
                  <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                    <a href="{{ route('offer.destroy', $offer->id) }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Supprimer</a>
                    <button x-on:click="open{{ $offer->id }} = false" type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Annuler</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endcan

      </h6>
        
    </div>
  @endif  
</div>
