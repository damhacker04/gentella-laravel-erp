{{-- Reusable Textarea Component --}}
@props([
    'name',
    'label' => '',
    'value' => null,
    'required' => false,
    'placeholder' => '',
    'rows' => 3,
    'disabled' => false,
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

    <textarea
        class="form-control @error($name) is-invalid @enderror"
        id="{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $disabled ? 'disabled' : '' }}
        {{ $attributes }}
    >{{ $val }}</textarea>

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
