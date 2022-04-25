@props(['disabled' => false, 'value' => null ])

<textarea maxlength="400" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'px-5 h-11 w-full shadow-sm border-0 border-b-2 border-black-900 focus:border-purple-900 focus:ring-0 focus:text-yellowkeeep']) !!}>{{$value}}</textarea>
