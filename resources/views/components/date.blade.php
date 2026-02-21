{{-- Reusable Date Picker Component --}}
@props([
    'name',
    'label' => '',
    'value' => null,
    'required' => false,
    'placeholder' => 'Pilih tanggal...',
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

    <div class="input-group">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
        <input
            type="text"
            class="form-control datepicker @error($name) is-invalid @enderror"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ $val }}"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            autocomplete="off"
            {{ $attributes }}
        >
        @error($name)
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
