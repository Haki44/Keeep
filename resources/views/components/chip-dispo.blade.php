@props(['offerDay' => 'null'])

@if (date_format(new DateTime($offerDay), 'Y-m-d') <= date_format(new DateTime(), 'Y-m-d')) 
  <div class="bg-yellowkeeep p-2 rounded-full text-white">
    Indisponible
  </div>
@else 
  <div class="bg-green-500 p-2 rounded-full text-white">
    Disponible
  </div>
@endif