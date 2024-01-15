@extends('layouts.app')

@section('content')
    <section>
        <div class="container d-flex justify-content-center py-5">
            <div class="d-flex flex-column gap-2">
                <h2 class="align-self-center">{{$project->project_name}}</h2>
                <p class="card-text">{{$project->description}}</p>
                <div class="d-flex gap-2">
                    <span class="fw-bold">Type: </span>
                    @if($project->type)
                        {{$project->type->name}}
                    @endif
                    <span>{{$project->development_type}}</span>
                </div>
                <div class="d-flex gap-2">
                    <span class="fw-bold">Status: </span>
                    <span>{{$project->project_status}}</span>
                </div>
                <div class="d-flex gap-2">
                    <span class="fw-bold">Github Link: </span>
                    <span>
                        <a href="{{$project->github_link}}" target="_blank">{{$project->github_link}}</a>
                    </span>
                </div>
                <div class="d-flex gap-2 py-2">
                    <a href="{{ route('admin.projects.edit',$project) }}" class="btn btn-warning">EDIT</a>
                    <button id="myBtn" class="btn btn-danger delete" style="width: fit-content">DELETE</button>
                </div>
                <ul class="d-flex gap-2 ps-0">
                    @foreach ($project->technologies as $technology)
                      <li class="badge rounded-pill text-bg-primary">{{ $technology->name }}</li>
                    @endforeach 
                  </ul>
                <div id="bgForm" class="bg-form">
                <div class="d-flex gap-3 delete-form">
                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-lg">Yes</button>
                    </form>
                    <button id="noBtn" class="btn btn-primary btn-lg">No</button>
                </div>
            </div>
        </div>
    </section>
@endsection