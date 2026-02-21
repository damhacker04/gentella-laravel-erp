{{-- Reusable Money Input Component --}}
@props([
    'name',
    'label' => '',
    'value' => null,
    'required' => false,
    'placeholder' => '0',
    'prefix' => 'Rp',
    'disabled' => false,
    'readonly' => false,
])

@php
    $val = old($name, $value ?? '');
@endphp

<div class="mb-3">
    @if($label)
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
        @if($required) <span class="required">*</span> @endif
    </label>
    @endif

    <div class="input-group">
        <span class="input-group-text">{{ $prefix }}</span>
        <input
            type="text"
            class="form-control money-format @error($name) is-invalid @enderror"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ $val ? number_format((int)$val, 0, ',', '.') : '' }}"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            {{ $readonly ? 'readonly' : '' }}
            {{ $attributes }}
        >
        @error($name)
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
