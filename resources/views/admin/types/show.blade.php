@extends('layouts.admin')



@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0"><strong>Type Name:</strong> {{ $type->name }}</h4>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <div class="fw-bold">Type Slug :</div>
                            <div class="text-muted">{{ $type->slug }}</div>
                        </div>

                    </div>
                </div>
            </div>
 @endsection
