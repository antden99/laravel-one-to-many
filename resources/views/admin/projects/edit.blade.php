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


        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    aria-describedby="nameHelpId" placeholder="Add name project"
                    value="{{ old('name', $project->name) }}" />
                <small id="nameHelpId" class="form-text text-muted">Type a name for this project</small>
                @error('name')
                    <div class="text-danger py-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="d-flex gap-2 mb-3">
                <!--Aggiungo lo snippet per capire quale tipologia di immagine visualizzare-->
                @if (Str::startsWith($project->cover_image, 'https://'))
                    <img width="140" src="{{ $project->cover_image }}" alt="{{ $project->title }}">
                @else
                    <img width="140" src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}">
                @endif
                <!---->

                <div>
                    <label for="cover_image" class="form-label">Update cover image</label>
                    <input type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image"
                        id="cover_image" aria-describedby="cover_imageHelper" placeholder="Learn php"
                        value="{{ old('cover_image', $project->cover_image) }}" />
                    <small id="cover_imageHelper" class="form-text text-muted">Type a cover_image for this project</small>
                    <!--snippet per visualizzare gli errori-->
                    @error('cover_image')
                        <div class="text-danger py-2">
                            {{ $message }}
                        </div>
                    @enderror
                    <!---->
                </div>
            </div>


            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="4" aria-describedby="descriptionHelpId"
                    placeholder="Add project description">{{ old('description', $project->description) }}</textarea>
                <small id="descriptionHelpId" class="form-text text-muted">Type a description for this project</small>
                @error('description')
                    <div class="text-danger py-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type_id" class="form-label">Type</label>
                <select class="form-select form-select-lg" name="type_id" id="type_id">
                    <option selected disabled>Select a type</option> <!--ricorda di aggiungere disabled perchè altrimenti i type potranno avere un valore non consentito e cradrai in errore!!-->
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }}>{{ $type->name }}</option>
                        <!--Attendione: inserisci il valore di defaoult se non ci sono errori di validazione. Se c'è un errore di validazione, allora utilizza il metodo old e recupera il primo parametro, se il primo parametro non c'è utilizza il valore di default come recupero-->
                    @endforeach
                </select>
            </div>


            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date"
                    id="start_date" aria-describedby="startDateHelpId"
                    value="{{ old('start_date', $project->start_date) }}" />
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
                    id="end_date" aria-describedby="endDateHelpId" value="{{ old('end_date', $project->end_date) }}" />
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
