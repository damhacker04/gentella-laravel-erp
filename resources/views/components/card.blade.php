{{-- Reusable Card Component --}}
@props([
    'title' => '',
    'headerActions' => null,
])

<div class="card" {{ $attributes }}>
    @if($title || $headerActions)
    <div class="card-header">
        <span>{{ $title }}</span>
        @if($headerActions)
        <div>{{ $headerActions }}</div>
        @endif
    </div>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
</div>
