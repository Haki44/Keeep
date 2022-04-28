@props(['offerDay' => null])
{{-- Format date offer : YY-MM-DD HH-MM-SS --}}
@if (date_format(new DateTime($offerDay), 'Y-m-d') >= date_format(new DateTime(), 'Y-m-d')) 
  <div class="w-32 p-2 text-white rounded-full bg-yellowkeeep">
    <p class="text-center">Indisponible</p>
  </div>
@else 
  <div class="w-32 p-2 text-white bg-green-500 rounded-full">
    <p class="text-center">Disponible</p>
  </div>
@endif