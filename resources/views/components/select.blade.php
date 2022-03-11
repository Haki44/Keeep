@props(['label', 'field', 'value' => null, 'values'])

<div class="form-group row">
    <x-label :field="$field" :label="$label" />

    <div class="w-full">
        <select name="{{ $field }}" id="{{ $field }}" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error($field) is-invalid @enderror">
            @foreach ($values as $k => $v)
                <option value="{{ $k }}" @if ($k == (old($field) ?? $value)) selected @endif>{{ $v }}</option>
            @endforeach
        </select>
        @error($field)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
