@extends('layouts.app')

@section('content')
    <section>
      <div class="container">
        <table class="table table-stripped">
          <thead>
            <tr>
              <td>
                  <form action="{{route('admin.projects.index')}}" method="GET">
                    <input class="form-control" placeholder="Filtra per titolo" type="text" name="title" value="{{ request()->get('title') }}">
                  </form>
              </td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
                <th>Project Name</th>
                <th>Type</th>
                <th>Github</th>
                <th>Status</th>
                <th>        
                  <a href="{{route('admin.projects.create')}}" class="btn btn-sm btn-success colspan-2" style="font-size: 16px">NEW</a>
                </th>
            </tr>
          </thead>
          <tbody>
            @forelse ($projects as $project)
                <tr class="align-middle">
                    <td>
                    <a href="{{ route('admin.projects.show',$project) }}">
                        {{ $project->project_name  }}
                        </a>
                    </td>
                    <td> {{ isset($project->type) ?  $project->type->name : '-' }} </td>
                    <td>{{ $project->github_link }}</td>
                    <td>{{ $project->project_status }}</td>
                    <td>
                        <div class="d-flex gap-2 align-items-center">
                            <a href="{{ route('admin.projects.edit',$project) }}" class="btn btn-warning">EDIT</a>
                        </div>                        
                    </td>
                </tr>
            @empty
                <tr>
                  <td>No Projects Found</td>
                </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </section>
@endsection