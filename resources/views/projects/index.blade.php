<x-gotime-app-layout layout="{{ config('naykel.template') }}" hasContainer class="py-5-3-2">

    <h1>{{ $title ?? null }}</h1>

    @forelse ($projects as $project)

        <div><a href="{{ route('projects.show', $project->id) }}">{{ $project->title }}</a></div>

    @empty

        <div>No projects to display</div>

    @endforelse

</x-gotime-app-layout>
