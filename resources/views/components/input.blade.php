@props(['disabled' => false, 'icon' => null, 'type' => null])

@php
    switch ($icon) {
        case 'email':
            $svg = '<svg class="w-4 h-4 text-black"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <rect x="3" y="5" width="18" height="14" rx="2" />  <polyline points="3 7 12 13 21 7" /></svg>';
            break;
        case 'password':
            $svg = '<svg class="w-4 h-4 text-black"  fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>';
            break;
        case 'description':
            $svg = '<svg class="w-4 h-4 text-black"  fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>';
            break;    
        case 'profil':
            $svg =  '<svg class="w-4 h-4 text-black"  fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
            break;   
        case 'offer':
            $svg = '<svg class="w-4 h-4 text-black"  fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>';
            break;    
    }
@endphp

<div class="relative pb-1">
    @if ($icon)
        <i class="absolute top-2.5">
            {!! $svg !!}
        </i> 
    @endif

    <input {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge([
        'type' => $type, 
        'class' => 'w-full px-5 py-2 leading-tight text-gray-700 border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:bg-white focus:border-purple-900 focus:text-yellowkeeep focus:ring-0']) }}>
</div>
