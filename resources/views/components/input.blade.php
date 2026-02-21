{{-- Reusable Input Component --}}
@props([
    'name',
    'label' => '',
    'type' => 'text',
    'value' => null,
    'required' => false,
    'placeholder' => '',
    'disabled' => false,
    'readonly' => false,
    'hint' => '',
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

    <input
        type="{{ $type }}"
        class="form-control @error($name) is-invalid @enderror"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $val }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $disabled ? 'disabled' : '' }}
        {{ $readonly ? 'readonly' : '' }}
        {{ $attributes }}
    >

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @if($hint)
        <div class="form-text">{{ $hint }}</div>
    @endif
</div>
