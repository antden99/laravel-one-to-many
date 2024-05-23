@extends('layouts.admin')


@section('content')
    <div class="container">
        <div class="row">


            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show py-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif


            <a href="{{ route('admin.projects.create') }}" class="p-4"><button class="btn btn-primary">Add
                    Project</button></a>
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>COVER_IMAGE</th>
                            <th>NAME</th>
                            <th>START_DATE</th>
                            <th>END_DATE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr>

                                <td>{{ $project->id }}</td>
                                <td>
                                    <!--Ricordati di aggiungere questo script per controllare se la stringa inizia con https, perchè significa che ha un percorso completo, altrimenti è stata caricata dall'utente-->
                                    @if (Str::startsWith($project->cover_image, 'https://'))
                                        <img width="140" loading="lazy" src="{{ $project->cover_image }}"
                                            alt="{{ $project->name }}">
                                    @else
                                        <img width="140" loading="lazy"
                                            src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->name }}">
                                    @endif
                                </td>
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->start_date }}</td>
                                <td>{{ $project->end_date }}</td>
                                <td>
                                    <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-dark">
                                        <i class="fa-regular fa-eye"></i></a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-dark">
                                        <i class="fa-solid fa-pen-nib"></i></a>
                                </td>
                                <td>
                                    <!-- Modal trigger button -->
                                    <button type="button" class="btn btn-danger " data-bs-toggle="modal"
                                        data-bs-target="#modalId-{{ $project->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>

                                    <!-- Modal Body -->
                                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                    <div class="modal fade" id="modalId-{{ $project->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="modalTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTitleId">
                                                        Be careful, you are eliminating the project from your list!!
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">You are deleting the project {{ $project->title }}
                                                    permanently!</div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Cancel <!--Annulla la modale-->
                                                    </button>
                                                    <form action="{{ route('admin.projects.destroy', $project) }}"
                                                        method="post">
                                                        @csrf <!--ricorda di aggiungere sempre il token univoco-->
                                                        @method('DELETE')
                                                        <!--aggiungi sempre method 'delete' per indicare che questo form post è di tipo delete-->
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fa-solid fa-trash-can"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endsection
