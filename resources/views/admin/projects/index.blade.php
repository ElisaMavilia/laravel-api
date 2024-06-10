@extends('layouts.admin')


@section('content')
<section class="container mt-4">
@if(session()->has('message'))
    <div class="alert alert-success">{{session()->get('message')}}</div>
    @endif
    <div class="d-flex justify-content-between align-items-center py-4">
        <h1>Projects</h1>
        <a href="{{route('admin.projects.create')}}" class="btn btn-warning">Add new project</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Content</th>
                <th scope="col">Slug</th>
                <th scope="col">Update at</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                    <tr class="table table-striped-columns">
                        
                        <td>{{$project->id}}</td>
                        <td><img width="100" src="{{asset('storage/' . $project->image)}}" alt="{{$project->title}}"></td>
                        <td>{{$project->title}}</td>
                        <td>{{$project->content}}</td>
                        <td scope="row">{{$project->slug}}</td>
                        <td>{{$project->created_at}}</td>
                        <td>{{$project->updated_at}}</td>
                        <td>
                    <a href="{{route('admin.projects.show', $project->slug)}}"><i class="fa-solid fa-eye"></i></a>
                    <a href="{{route('admin.projects.edit', $project->slug)}}"><i class="fa-solid fa-pen"></i></a>
                    <form action="{{route('admin.projects.destroy', $project->slug)}}" method="POST" class="d-inline-block">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="delete-button border-0 bg-transparent"  data-item-title="{{ $project->title }}">
                        <i class="fa-solid fa-trash"></i>
                      </button>
                    </form>
                </td>
              </tr>
            @endforeach
          </tbody>
      </table>
</section>
<div class="container mt-4">
{{ $projects->links('vendor.pagination.bootstrap-5') }}
</div>
@endsection