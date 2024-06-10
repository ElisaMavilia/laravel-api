@extends('layouts.admin')
@section('title', $project->title)

@section('content')
<section class="container mt-4">
    <h1>{{$project->title}}</h1>
    <img src="{{asset('storage/' . $project->image)}}" alt="{{$project->title}}">
    <p>{{$project->content}}</p>
    <div>
      @if($project->category)
      <p class="text-secondary">Category: {{$project->category->name}}</p>
      @endif
    </div>
    <div class="my-3">
         @if($project->technologies)
            @foreach ($project->technologies as $technology)
            <span class="badge text-bg-success">{{$technology->name}}</span>
            @endforeach
          @endif
    </div>

  
    <a href="{{route('admin.projects.edit', $project->slug)}}" class="btn btn-secondary">Edit</a>
            <form action="{{route('admin.projects.destroy', $project->slug)}}" method="POST" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button btn btn-warning"  data-item-title="{{ $project->title }}">
                 Delete</i>
                </button>
              </form>

</section>
@endsection