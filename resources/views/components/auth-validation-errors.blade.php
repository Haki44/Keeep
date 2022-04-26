@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600">
            {{ 'Whoops! Quelque chose s\'est mal passé.' }}
        </div>

        <ul class="mt-3 text-sm text-white list-disc list-inside p-4 mb-4 red rounded-lg">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
