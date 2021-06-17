@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('projects.delete', $project) }}" method="post" class="float-right form-delete">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
                <h1>{{ $project->title }}</h1>
                <hr>

                @if($project->tasks->count())
                    <table class="table table-hover table-bordered table-striped mb-4">
                        <tbody>
                        @foreach($project->tasks as $task)
                            <tr>
                                <td width="1px" class="align-middle">
                                    <input
                                        type="checkbox"
                                        class="update-input"
                                        data-route="{{ route('tasks.update', $task) }}"
                                        data-field="is_done"
                                        {{ $task->is_done ? 'checked' : '' }}
                                    >
                                </td>
                                <td title="{{ $task->description ?? 'No description...' }}">
                                    <input
                                        type="text"
                                        value="{{ $task->title }}"
                                        data-route="{{ route('tasks.update', $task) }}"
                                        data-field="title"
                                        class="form-control update-input"
                                    >
                                </td>
                                <td width="1px">
                                    <form action="{{ route('tasks.delete', $task) }}" method="post" class="form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="card mb-4">
                        <div class="card-body p-5 text-center">
                            <h3 class="mb-0 font-weight-bold">No projects found...</h3>
                        </div>
                    </div>
                @endif

                <div class="card">
                    <form action="{{ route('tasks.store', $project) }}" method="post">
                        @csrf
                        <div class="card-header">
                            <strong>Create Task</strong>
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
                                    autofocus
                                >
                                @error('title')
                                <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="title">Description</label>
                                <textarea
                                    type="text"
                                    class="form-control"
                                    placeholder="Write an optional description"
                                    name="description"
                                    id="description"
                                >{{ old('description') }}</textarea>
                                @error('description')
                                <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-right">
                                <button class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
