@props(['label', 'type', 'name', 'placeholder', 'details', 'readonly', 'required'])
@php
    if (!isset($readonly)) {
        $readonly = false;
    }
    if (!isset($required)) {
        $required = false;
    }
@endphp

<section>
    <label for="{{ $name }}">
        {{ $label }}:
        @if ($required)
            <sup><i class="fas fa-star text-danger" style="font-size:7px;"></i></sup>
        @endif
    </label>

    @if ($type === 'textarea')
        <textarea name="{{ $name }}" rows="3"
            class="form-control @error($name) is-invalid @enderror {{ old($name) && !$errors->has($name) ? 'is-valid' : '' }}"
            id="{{ $name }}" placeholder="{{ $placeholder }}">{{ old($name, isset($details) ? $details->$name : '') }}</textarea>
    @elseif($type === 'select')
        <select name="{{ $name }}" id="{{ $name }}"
            value="{{ old($name, isset($details) ? $details->$name : '') }}"
            class="form-control modern-select form-control-sm @error($name) is-invalid @enderror {{ old($name) && !$errors->has($name) ? 'is-valid' : '' }}">
            {{ $slot }}
        </select>
    @else
        <input name="{{ $name }}" type="{{ $type }}" @if ($readonly) readonly @endif
            id="{{ $name }}" value="{{ old($name, isset($details) ? $details->$name : '') }}"
            class="form-control-sm form-control @error($name) is-invalid @enderror {{ old($name) && !$errors->has($name) ? 'is-valid' : '' }}"
            placeholder="{{ $placeholder }}">
        </input>
    @endif

    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @else
        @if (old($name) && !$errors->has($name))
            <span class="valid-feedback" role="alert">
                <strong></strong>
            </span>
        @endif
    @enderror
</section>
