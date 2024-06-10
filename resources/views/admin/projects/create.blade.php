@extends('layouts.admin')

@section('title', 'Create Project')

@section('content')

<section>
    <h2>Create new Project</h2>
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container mb-3 mt-4">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" aria-describedby="titleHelp" name="title" value="{{old('title')}}">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
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
           <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{old('content')}}</textarea>
           @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
                <label for="category_id" class="form-label">Select Category</label>
                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                    <option value="">Select Category</option>
                  @foreach ($categories as $category)
                      <option value="{{$category->id}}" {{ $category->id == old('category_id') ? 'selected' : '' }}>{{$category->name}}</option>
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
                            {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
                        <label for="" class="form-check-label">{{ $technology->name }}</label>
                    </div>
                @endforeach
                @error('technologies')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
          <div class="mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Cancel</button>
            </div>
    </form>
</section>
@endsection