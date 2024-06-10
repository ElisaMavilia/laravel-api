@extends('layouts.admin')

@section('title', 'Edit Project' . $project->title)

@section('content')

<section id="edit-project">
    <h2>Edit project: {{ $project->title }}</h2>
    <form action="{{ route('admin.projects.show', $project->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="container mb-3 mt-4">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" aria-describedby="titleHelp" name="title" value="{{old('title', $project->title)}}">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
            @if($project->image)
                    <img class="shadow" width="150" src="{{asset('storage/' . $project->image)}}" alt="{{$project->title}}" id="uploadPreview">
                    @else
                    <img class="shadow" width="150" src="/images/placeholder.png" alt="{{$project->title}}" id="uploadPreview">
                    @endif
                <img id="uploadPreview" width="100" src="/images/placeholder.png">
                <label for="image" class="form-label">Image</label>
                <input type="file" accept="image/*" class="form-control @error('image') is-invalid @enderror" id="uploadImage"
                    name="image" value="{{ old('image') }}" maxlength="255">
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
          <div class="mb-3">
            <label for="content" class="form-label @error('title') is-invalid @enderror">Content</label>
           <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{old('content', $project->content)}}</textarea>
           @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
                <label for="category_id" class="form-label">Select Category</label>
                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                    <option value="">Select Category</option>
                  @foreach ($categories as $category)
                      <option value="{{$category->id}}" {{ $category->id == $project->category_id ? 'selected' : '' }}>{{$category->name}}</option>
                  @endforeach
                </select>
                @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group mb-3">
                <p>Select one or more Technologies:</p>
                @foreach ($technologies as $technology)
                    <div>
                        <input type="checkbox" name="technologies[]" value="{{ $technology->id }}" class="form-check-input"
                            {{ $project->technologies->contains($technology->id) ? 'checked' : '' }}>
                        <label for="" class="form-check-label">{{ $technology->name }}</label>
                    </div>
                @endforeach
                @error('projects')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
          <div class="mb-3">
                <button type="submit" class="btn btn-primary">Edit</button>
                <button type="reset" class="btn btn-danger">Cancel</button>
            </div>
    </form>
</section>
@endsection