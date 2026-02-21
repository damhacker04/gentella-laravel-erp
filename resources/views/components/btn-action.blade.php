{{-- Action Buttons for CRUD Tables --}}
@props([
    'showRoute' => null,
    'editRoute' => null,
    'deleteRoute' => null,
    'showPermission' => null,
    'editPermission' => null,
    'deletePermission' => null,
])

<div class="btn-action-group">
    @if($showRoute)
        @if(!$showPermission || auth()->user()->can($showPermission))
        <a href="{{ $showRoute }}" class="btn btn-sm btn-info" title="Detail">
            <i class="fas fa-eye"></i>
        </a>
        @endif
    @endif

    @if($editRoute)
        @if(!$editPermission || auth()->user()->can($editPermission))
        <a href="{{ $editRoute }}" class="btn btn-sm btn-warning" title="Ubah">
            <i class="fas fa-edit"></i>
        </a>
        @endif
    @endif

    @if($deleteRoute)
        @if(!$deletePermission || auth()->user()->can($deletePermission))
        <form action="{{ $deleteRoute }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-sm btn-danger btn-delete" title="Hapus">
                <i class="fas fa-trash"></i>
            </button>
        </form>
        @endif
    @endif
</div>
