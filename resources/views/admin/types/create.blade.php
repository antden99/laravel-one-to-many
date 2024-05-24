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


        <form action="{{ route('admin.types.store') }}" method="POST">
            <!--Non ti dimenticare di aggiungere enctype se devi permettere il caricamento dell'immagine nel form-->
            @csrf


            <div class="mb-3">
                <label for="name" class="form-label">Name Type</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    aria-describedby="nameHelpId" placeholder="Add name project" value="{{ old('name') }}" />
                <small id="nameHelpId" class="form-text text-muted">Type a name for this type</small>
                @error('name')
                    <div class="text-danger py-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create New Type</button>
        </form>
    </div>


@endsection
