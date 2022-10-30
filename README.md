<p align="center"><a href="https://naykel.com.au" target="_blank"><img src="https://avatars0.githubusercontent.com/u/32632005?s=460&u=d1df6f6e0bf29668f8a4845271e9be8c9b96ed83&v=4" width="120"></a></p>

# Demo Site for Laravel and Livewire Development and Testing

- [Initial Set up](#initial-set-up)
- [WithDataTable Trait](#withdatatable-trait)
    - [Search Functions](#search-functions)
    - [Sort Functions](#sort-functions)
- [WithCrud Trait](#withcrud-trait)
    - [Remember form values on escape](#remember-form-values-on-escape)
    - [`makeBlankModel()`](#makeblankmodel)
- [File Uploads](#file-uploads)
- [Gotime search-sort toolbar component](#gotime-search-sort-toolbar-component)
        - [Trouble Shooting](#trouble-shooting)

## Initial Set up

- [x] Create `Project` controller model, migration, and factory
- [x] Create `AdditionalImage` model, migration, and factory
- [x] Create `views.project` folder and include views for `show` and `index`
- [x] Create routes for `project.show` and `project.index`
- [x] Add `Model::unguard` in the app service provider to disable all mass assignable restrictions
- [x] Add additional database fields to migration(s)
- [x] Create `projects` disk in `filesystems.php` for image storage
- [x] Create livewire `ProjectTable` component, and view
