<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithCrud;
use App\Http\Livewire\Traits\WithDataTable;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Project;


class ProjectTable extends Component
{

    use WithPagination, WithDataTable, WithCrud;

    public string $searchField = 'title';
    public array $searchOptions = ['title', 'status'];
    public int $perPage = 10;
    public array $paginateOptions = [10, 25, 50, 100];
    public bool $showModal;
    public $tmpImage;
    public $tmpAdditionalImages = [];

    /**
     * Primary resource model class
     * @var string
     */
    private static $model = Project::class;

    /**
     * Default values for blank model
     * @var string[]
     */
    protected $initialData = ['status' => 'draft'];

    /**
     * Blank model if 'create', or selected model from database if 'edit'
     * @var Project
     */
    public Project $editing;

    /**
     * Storage disk for images
     * @var string
     */
    protected string $disk = 'projects';

    public function rules()
    {
        return [
            'editing.id' => 'sometimes', // required for data binding
            'editing.title' => 'required|max:256',
            'editing.status' => 'sometimes|in:' . collect(Project::STATUS)->keys()->implode(','),
            'editing.sort_order' => 'nullable|integer',
            'editing.project_value' => 'nullable|numeric',
            'editing.description' => 'sometimes',
            'editing.client' => 'sometimes',
            'editing.location' => 'sometimes',
            'editing.date_started' => 'sometimes',
            'editing.date_completed' => 'sometimes',
            'editing.published_at' => 'sometimes',
            'tmpImage' => 'nullable|image',
            'tmpAdditionalImages.*' => 'nullable|image'
        ];
    }

    public function cancel(): void
    {
        $this->showModal = false;
    }

    public function render()
    {
        sleep(1);
        $query = self::$model::search($this->searchField, $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.project-table')->with([
            'projects' => $query,
        ])->layout('gotime::layouts.admin');
    }
}
