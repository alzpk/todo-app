@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Projects</h1>
                <hr>

                <div class="card mb-4">
                    <form action="{{ route('projects.store') }}" method="post">
                        @csrf
                        <div class="card-header">
                            <strong>Add Project</strong>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Write a project title"
                                    name="title"
                                    id="title"
                                    value="{{ old('title') }}"
                                >
                                @error('title')
                                <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-right">
                                <button class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>

                @if($projects->count())
                    <table class="table table-hover table-bordered mb-0">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th class="text-center" width="100px">Progress</th>
                            <th width="1px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->title }}</td>
                                <td class="text-center">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $project->progress }}%;" aria-valuenow="{{ $project->progress }}" aria-valuemin="0" aria-valuemax="100">{{ $project->finished_tasks }}/{{ $project->tasks->count() }}</div>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('projects.show', $project) }}" class="btn btn-sm btn-dark">
                                        Tasks
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="card">
                        <div class="card-body p-5 text-center">
                            <h3 class="mb-0 font-weight-bold">No projects found...</h3>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
