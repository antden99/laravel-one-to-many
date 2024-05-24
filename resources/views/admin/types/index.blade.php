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


            <a href="{{route('admin.types.create')}}" class="p-4"><button class="btn btn-primary">Add
                    Type</button></a>
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>TYPE NAME</th>
                            <th>TYPE-SLUG</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($types as $type)
                            <tr>

                                <td>{{ $type->id }}</td>

                                <td>{{ $type->name }}</td>
                                <td>{{ $type->slug }}</td>
                                <td>
                                    <a href="{{ route('admin.types.show', $type) }}" class="btn btn-dark">
                                        <i class="fa-regular fa-eye"></i></a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.types.edit', $type) }}" class="btn btn-dark">
                                        <i class="fa-solid fa-pen-nib"></i></a>
                                </td>
                                <td>
                                    <!-- Modal trigger button -->
                                    <button type="button" class="btn btn-danger " data-bs-toggle="modal"
                                        data-bs-target="#modalId-{{ $type->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>

                                    <!-- Modal Body -->
                                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                    <div class="modal fade" id="modalId-{{ $type->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="modalTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTitleId">
                                                        Be careful, you are eliminating the type from your list!!
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">You are deleting the type {{ $type->title }}
                                                    permanently!</div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Cancel <!--Annulla la modale-->
                                                    </button>
                                                    <form action="{{ route('admin.types.destroy', $type) }}" method="post">
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
