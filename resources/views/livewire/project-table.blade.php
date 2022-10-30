<div>

    <div class="flex space-between va-c">

        <x-gt-search-sort-toolbar :searchField="$searchField" :searchOptions="$searchOptions" :paginateOptions="$paginateOptions" />

        <button wire:click="create" class="btn primary">
            <x-iconit.plus-round-o class="mr-05" />New</button>

    </div>

    <table class="fullwidth">

        <thead>
            <x-gt-table.th sortable wire:click="sortField('title')" :direction="$sortField === 'title' ? $sortDirection : null" class="fullwidth">Title</x-gt-table.th>
            <x-gt-table.th sortable wire:click="sortField('created_at')" :direction="$sortField === 'created_at' ? $sortDirection : null">Created</x-gt-table.th>
            <x-gt-table.th sortable wire:click="sortField('published_at')" :direction="$sortField === 'published_at' ? $sortDirection : null">Published</x-gt-table.th>
            <x-gt-table.th sortable wire:click="sortField('status')" :direction="$sortField === 'status' ? $sortDirection : null">Status</x-gt-table.th>
            <x-gt-table.th sortable wire:click="sortField('sort_order')" :direction="$sortField === 'sort_order' ? $sortDirection : null">Order</x-gt-table.th>
        </thead>

        <tbody wire:loading.class="txt-muted">

            @forelse($projects as $project)

                <tr>
                    <td class="fullwidth">{{ $project->title }}</td>
                    <td>{{ $project->created_at }}</td>
                    <td>{{ $project->published_at }}</td>
                    <td>{{ $project->status }}</td>
                    <td class="tac">{{ $project->sort_order }}</td>
                </tr>

            @empty

                <tr>
                    <td class="tac pxy txt-lg" colspan="6">No records found...</td>
                </tr>

            @endforelse

        </tbody>

    </table>

    {{ $projects->links('gotime::pagination.livewire') }}

</div>

@push('styles')

    <style>
        td {
            white-space: nowrap;
        }

    </style>

@endpush
