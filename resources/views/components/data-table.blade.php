{{-- Data Table Wrapper Component --}}
@props([
    'id' => 'data-table',
])

<div class="table-responsive">
    <table id="{{ $id }}" class="table table-striped datatable" style="width:100%">
        <thead>
            <tr>
                {{ $head }}
            </tr>
        </thead>
        <tbody>
            {{ $body }}
        </tbody>
    </table>
</div>
