@extends('layouts.admin')



@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0"><strong>Project Name:</strong> {{ $project->name }}</h4>
                    </div>

                    <div class="mb-3 text-center">
                        @if (Str::startsWith($project->cover_image, 'https://'))
                            <img width="200"  class="border"      loading="lazy" src="{{ $project->cover_image }}" alt="{{ $project->name }}">
                        @else
                            <img width="200" loading="lazy" src="{{ asset('storage/' . $project->cover_image) }}"
                                alt="{{ $project->name }}">
                        @endif
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <div class="fw-bold">Description:</div>
                            <div class="text-muted">{{ $project->description }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Start Date:</div>
                            <div class="text-muted">{{ $project->start_date }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">End Date:</div>
                            <div class="text-muted">{{ $project->end_date }}</div>
                        </div>
                    </div>
                </div>
</div @endsection
