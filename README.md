<p align="center"><a href="https://naykel.com.au" target="_blank"><img src="https://avatars0.githubusercontent.com/u/32632005?s=460&u=d1df6f6e0bf29668f8a4845271e9be8c9b96ed83&v=4" width="120"></a></p>

# Demo Site for Laravel and Livewire Development and Testing

- [Initial Set up](#initial-set-up)
- [Create Data Table with Search and Sort](#create-data-table-with-search-and-sort)
- [Add CRUD functions](#add-crud-functions)
    - [Remember form values on escape](#remember-form-values-on-escape)

## Initial Set up

- [x] Create `Project` controller model, migration, and factory
- [x] Create `AdditionalImage` model, migration, and factory
- [x] Create `views.project` folder and include views for `show` and `index`
- [x] Create routes for `project.show` and `project.index`
- [x] Add `Model::unguard` in the app service provider to disable all mass assignable restrictions
- [x] Add additional database fields to migration(s)
- [x] Create `projects` disk in `filesystems.php` for image storage
- [x] Create livewire `ProjectTable` component, and view


## Create Data Table with Search and Sort

- [x] Add search macro to `AppServiceProvider`
- [x] Create `WithDataTable` trait for pagination, search, and sort functions
- [x] Create data table with Gotime table and toolbar components

###### Search Macro

Add search macro to `boot()` method of the `AppServiceProvider`.


```php
use Illuminate\Database\Eloquent\Builder;

Builder::macro('search', function ($field, $string) {
    return $string ? $this->where($field, 'like', '%' . $string . '%') : $this;
});
```

## Add CRUD functions

- [x] Create `WithCrud` trait
- [x] CRUD functions `edit`, `create`, `save`, `delete`
    - [x] `makeBlankModel()` to initialize blank model with default values
    - [x] `handleImage()` for main project image
- [x] Create/Edit form in modal


### Remember form values on escape

Offers protection if accidentally escape and close form before saving.

Save Method - Works by checking if the if `$editing` model has a primary key,
if there is a primary key then it is safe to assume it is a record from the
database so don't reset the fields (leave them with the escaped values)

```php
if ($this->editing->getKey()) $this->editing = $this->makeBlankModel();
```

Edit Method - uses helper to compare the `$editing` model is not equal to the
`$selected` model passed in. If not equal override, otherwise leave it alone.

```php
if ($this->editing->isNot($selected)) $this->editing = $selected;
```
