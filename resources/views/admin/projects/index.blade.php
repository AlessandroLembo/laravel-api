@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    <header>
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="text-center my-5 fs-1">Projects</h1>
            <div>
                <a href="{{ route('admin.projects.create') }}" class="btn btn-success mt-2">Aggiungi Progetto</a>
                <a href="{{ route('admin.types.create') }}" class="btn btn-secondary mt-2">Crea nuovo tipo</a>
                <a href="{{ route('admin.technologies.create') }}" class="btn btn-dark mt-2">Crea nuova tecnologia</a>
            </div>
            
        </div>

        <div class="input-group my-4">
            <form action="{{ route('admin.projects.index') }}" method="GET">
                <div class="input-group">
                    <button class="btn btn-outline-secondary" type="submit">Filtra</button>
                    <select class="form-select" name="filter">
                      <option selected value="">Tutte</option>
                      <option value="published">Pubblicati</option>
                      <option value="drafts">Bozze</option>
                    </select>
                </div>
            </form>
        </div>
       
    </header>
      <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Poject for</th>
                    <th scope="col">Technologies</th>
                    <th scope="col">Platform</th>
                    <th scope="col">Stato</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                    <tr>
                        <th scope="row">{{ $project->id }}</th>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->type?->label }}</td>
                        <td>{{ $project->project_for }}</td>
                        <td>
                            @forelse ($project->technologies as $technology)
                                <span class="badge bg-{{ $technology->color }}">{{ $technology->label }}</span>
                            @empty
                                
                            @endforelse
                        </td>
                        <td>{{ $project->web_platform }}</td>
                        <td>
                            <form action="{{ route('admin.projects.toggle', $project->id) }}" method="POST">
                                @method('PATCH')
                                @csrf
                                <button type="submit" class="btn btn-outline">
                                    <i class="fa-2x fas fa-toggle-{{ $project->is_published ? 'on' : 'off' }} {{ $project->is_published ? 'text-success' : 'text-danger' }}"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <div class="d-flex justify-content-end align-items-center">
                                <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-sm btn-primary"><i
                                    class="fa-solid fa-eye"></i></a>

                                <a class="btn btn-sm btn-warning ms-2" href="{{ route('admin.projects.edit', $project->id) }}">
                                    <i class="fa-solid fa-pen-to-square"></i></a>
    
                                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST"
                                    class="delete-form" data-entity="progetto">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger ms-2"><i
                                            class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                          
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th scope="row" colspan="8" class="text-center">Non ci sono progetti</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

        <div class="d-flex justify-content-end">
                {{-- Stampo il paginatore --}}
                {{ $projects->links() }}
        </div>
@endsection
