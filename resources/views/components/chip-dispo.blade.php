@props(['offerDay' => null])
{{-- commentaire date --}}
@if (date_format(new DateTime($offerDay), 'Y-m-d') >= date_format(new DateTime(), 'Y-m-d')) 
  <div class="w-32 bg-yellowkeeep p-2 rounded-full text-white">
    <p class="text-center">Indisponible</p>
  </div>
@else 
  <div class="w-32 bg-green-500 p-2 rounded-full text-white">
    <p class="text-center">Disponible</p>
  </div>
@endif