<?php

namespace App\Http\Livewire\Traits;

use Livewire\WithFileUploads;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait WithCrud
{
    use WithFileUploads;

    public function mountWithCrud()
    {
        // $this->editing = $this->makeBlankModel();
        $this->editing = self::$model::find(1);
    }

    /**
     * Create blank model with default values
     */
    public function create(): void
    {
        $this->editing = $this->makeBlankModel();
        $this->showModal = true;
    }

    /**
     * Edit the selected model
     */
    public function edit($id): void
    {
        $selected = self::$model::find($id);
        $this->editing = $selected;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $this->checkIfPublished();

        $this->editing->save();

        if ($this->tmpImage) {
            $this->handleImage($this->tmpImage, $this->disk);
        }

        if ($this->tmpAdditionalImages) {
            $this->handleAdditionalImages($this->tmpAdditionalImages, $this->disk);
        }

        $this->dispatchBrowserEvent('pondReset');
        $this->dispatchBrowserEvent('notify', 'Saved!');
    }

    protected function checkIfPublished(): void
    {
        if ($this->editing->status == 'draft') {
            $this->editing->published_at = null;
        } elseif ($this->editing->status == 'published' && $this->editing->published_at == null) {
            $this->editing->published_at = now();
        }
    }

    public function delete($id): void
    {
        $project = self::$model::find($id);
        $project->delete();
    }

    /**
     * Upload given file and delete old one if exists
     * @param UploadedFile $file
     * @param mixed $disk e.g. 'projects', 'public' ....
     * @param string $dbField e.g. 'image', 'avatar' ...
     * @return void
     */
    public function handleImage(UploadedFile $file, $disk = 'public', $dbField = 'image'): void
    {
        // compares the database field to the uploaded file
        tap($this->editing->$dbField, function ($previous) use ($file, $disk, $dbField) {
            $this->editing->forceFill([
                $dbField => $file->store('/', $disk)
            ])->save();

            if ($previous) {
                Storage::disk($disk)->delete($previous);
            }
        });
    }

    public function handleAdditionalImages($files,  $disk = 'public'): void
    {
        foreach ($files as $file) {
            $this->editing->additionalImages()->create([
                'image' => $file->store('/', $disk)
            ]);
        }
    }

    /**
     * Create model instance and set default values. Does not persist.
     */
    public function makeBlankModel()
    {
        return self::$model::make($this->initialData);
    }
}
