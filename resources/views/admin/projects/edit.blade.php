@extends('layouts.admin')


@section('content')
    <div class="container p-4">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('admin.projects.update',$project) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    aria-describedby="nameHelpId" placeholder="Add name project" value="{{ old('name',$project->name) }}" />
                <small id="nameHelpId" class="form-text text-muted">Type a name for this project</small>
                @error('name')
                    <div class="text-danger py-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="cover_image" class="form-label">Cover_image</label>
                <input type="file" name="cover_image" id="cover_imageHelpId">
                <small id="cover_imageHelpId" class="form-text text-muted">Type a cover_image for this project</small>
                @error('cover_image')
                    <div class="text-danger py-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="4" aria-describedby="descriptionHelpId"
                    placeholder="Add project description">{{ old('description',$project->description) }}</textarea>
                <small id="descriptionHelpId" class="form-text text-muted">Type a description for this project</small>
                @error('description')
                    <div class="text-danger py-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date"
                    id="start_date" aria-describedby="startDateHelpId" value="{{ old('start_date',$project->start_date) }}" />
                <small id="startDateHelpId" class="form-text text-muted">Select the start date for this project</small>
                @error('start_date')
                    <div class="text-danger py-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                    id="end_date" aria-describedby="endDateHelpId" value="{{ old('end_date',$project->end_date) }}" />
                <small id="endDateHelpId" class="form-text text-muted">Select the end date for this project</small>
                @error('end_date')
                    <div class="text-danger py-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>



            <button type="submit" class="btn btn-primary">Create Project</button>
        </form>
    </div>
@endsection
