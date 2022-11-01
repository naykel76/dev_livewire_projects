<div>
    {{ $this->editing }}
    {{-- <x-gt-modal wire:model="showModal" maxWidth="xl"> --}}

        <div class="flex space-between va-c">
            <div class="bx-title">Edit/Add Project</div>
            <x-gotime-icon wire:click="$toggle('showModal')" icon="close" class="close sm" />
        </div>

        <form wire:submit.prevent="save">

            <div class="grid gg-3 cols-80:20">

                {{-- main content --}}
                <div class="bx">
                    <x-gt-input wire:model.defer="editing.title" for="editing.title" label="Title" rowClass="fg1" req inline />
                    <hr>
                    <x-gt-trix wire:model.lazy="editing.description" for="editing.description" label="Description" inline />
                    <hr>
                    {{-- main image --}}
                    <div class="grid cols-20:80 gg-3">
                        <div>
                            <div class="bx-title">Main Image</div>
                        </div>
                        <div>
                            <x-gt-filepond wire:model="tmpImage" />
                            <div>
                                @if($tmpImage)
                                    <img src="{{ $tmpImage->temporaryUrl() }}" alt="{{ $editing->title ?? null }}" class="h-100px mx-auto">
                                @else
                                    <img src="{{ $editing->mainImageUrl() }}" alt="{{ $editing->title ?? null }}" class="h-100px mx-auto">
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    {{-- additional images --}}
                    <div class="grid cols-20:80 gg-3">
                        <div>
                            <div class="bx-title">Additional Images</div>
                        </div>
                        <div>
                            <x-gt-filepond wire:model="tmpAdditionalImages" multiple />
                            <div class="grid cols-4-2-2">
                                @foreach($this->editing->additionalImages as $image)
                                    <img src="/storage/projects/{{ $image->image }}" alt="{{ $image->image }}">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                {{-- side --}}
                <div>
                    <x-gt-select wire:model.defer="editing.status" for="editing.status" label="Status">
                        @foreach(\App\Models\Project::STATUS as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </x-gt-select>
                    <x-gt-input wire:model.defer="editing.sort_order" for="editing.sort_order" label="Sort Order" />
                    <x-gt-input wire:model.defer="editing.project_value" for="editing.project_value" label="Project Value" />
                    <x-gt-input wire:model.defer="editing.published_at" for="editing.published_at" label="Published" />
                </div>
            </div>

            <div wire:loading wire:target="tmpImage">
                <x-gt-loading-indicator />
            </div>

        </form>

        <button wire:click="save()" class="btn primary">Save</button>
        <button wire:click="cancel()" class="btn">Cancel</button>

    {{-- </x-gt-modal> --}}

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
            <th></th>
        </thead>

        <tbody wire:loading.class="txt-muted">

            @forelse($projects as $project)

                <tr>
                    <td class="fullwidth">{{ $project->title }}</td>
                    <td>{{ $project->created_at }}</td>
                    <td>{{ $project->published_at }}</td>
                    <td>{{ $project->status }}</td>
                    <td class="tac">{{ $project->sort_order }}</td>
                    <td>
                        <button wire:click.prevent="edit({{ $project->id }})" class="btn link px-025">Edit</button>
                        <button wire:click.prevent="delete({{ $project->id }})" onclick="confirm('This action can not be undone are you sure?')" class="btn link px-025">Delete</button>
                    </td>
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
