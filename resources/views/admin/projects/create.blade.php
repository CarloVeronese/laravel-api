@extends('layouts.app')

@section('content')

<section class="py-5">
  <div class="container">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form action="{{ route('admin.projects.store') }}" method="POST" >
      @csrf

      <div class="mb-3">
        <label for="project_name" class="form-label">Title</label>
        <input type="text" class="form-control" name="project_name" id="project_name" placeholder="Titolo" required value="{{old('project_name')}}">
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Project description">{{old('description')}}</textarea>
      </div>

      <div class="mb-3">
        <label for="type_id" class="form-label">Type</label>
        <select type="text" class="form-control" name="type_id" id="type_id">
          <option>Select a project type</option>
          @foreach($types as $type)
            <option @selected( old('type_id') == $type->id) value="{{ $type->id }}">{{ $type->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="project_status" class="form-label">Status</label>
        <select type="text" class="form-control" name="project_status" id="project_status" placeholder="Project Status" required value="{{old('project_status')}}">
            <option class="text-secondary">Select Status</option>
            <option value="to start">To Start</option>
            <option value="in progress">In Progress</option>
            <option value="completed">Completed</option>
        </select>
      </div>

      <div class="form-group mb-3">
        <p>Select Technologies:</p>
        <div class="d-flex flex-wrap gap-4 ">
          @foreach ($technologies as $technology)
            <div class="form-check">
              <input name="technologies[]" class="form-check-input" type="checkbox" value="{{$technology->id}}" id="technology-{{$technology->id}}" @checked( in_array($technology->id, old('technologies',[]) ) ) >
              <label class="form-check-label" for="technology-{{$technology->id}}">
                {{ $technology->name }}
              </label>
            </div>
          @endforeach
        </div>

      <div class="mt-3">
        <input type="submit" class="btn btn-primary" value="Create">
      </div>
    </form>
  </div>
</section>

@endsection