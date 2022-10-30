<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithDataTable;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Project;

class ProjectTable extends Component
{

    use WithPagination, WithDataTable;

    /**
     * Default search field
     * @var string
     */
    public string $searchField = 'title';

    /**
     * Available search fields
     * @var array
     */
    public array $searchOptions = ['title', 'status'];

    /**
     * Default value for pagination results
     * @var int
     */
    public int $perPage = 10;

    /**
     * Pagination value options
     * @var array
     */
    public array $paginateOptions = [10, 25, 50, 100];

    /**
     * Primary resource model class
     * @var string
     */
    private static $model = Project::class;


    public function render()
    {
        sleep(1);

        $query = self::$model::search($this->searchField, $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.project-table')->with([
            'projects' => $query,
        ]);
    }
}
