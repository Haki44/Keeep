@props(['label', 'field', 'value' => null, 'values'])

<div class="form-group row">
    <x-label :field="$field" :label="$label" />

    <div class="col-md-6">
        <select name="{{ $field }}" id="{{ $field }}" class="form-control @error($field) is-invalid @enderror">
            @foreach ($values as $k => $v)
                <option value="{{ $k }}" @if($k == (old($field) ?? $value)) selected @endif>{{ $v }}</option>
            @endforeach
        </select>
        @error($field)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
