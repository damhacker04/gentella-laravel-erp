{{-- Reusable Select Component --}}
@props([
    'name',
    'label' => '',
    'options' => [],
    'optionValue' => 'id',
    'optionLabel' => 'name',
    'selected' => null,
    'required' => false,
    'placeholder' => 'Pilih...',
    'searchable' => false,
    'disabled' => false,
])

@php
    $selectedVal = old($name, $selected ?? '');
@endphp

<div class="mb-3">
    @if($label)
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
        @if($required) <span class="required">*</span> @endif
    </label>
    @endif

    <select
        class="{{ $searchable ? 'select2' : 'form-select' }} @error($name) is-invalid @enderror"
        id="{{ $name }}"
        name="{{ $name }}"
        data-placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $disabled ? 'disabled' : '' }}
        {{ $attributes }}
    >
        <option value="">{{ $placeholder }}</option>
        @foreach($options as $option)
            @php
                $val = is_array($option) ? ($option[$optionValue] ?? '') : ($option->$optionValue ?? $option);
                $lbl = is_array($option) ? ($option[$optionLabel] ?? '') : ($option->$optionLabel ?? $option);
            @endphp
            <option value="{{ $val }}" {{ (string)$selectedVal === (string)$val ? 'selected' : '' }}>
                {{ $lbl }}
            </option>
        @endforeach
    </select>

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
