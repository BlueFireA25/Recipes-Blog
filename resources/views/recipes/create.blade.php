@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css"/>
@endsection

@section('buttons')
    <a href="{{ route('recipes.index') }}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
        <i class="bi bi-caret-left-fill"></i> Go Back
    </a>
@endsection

@section('content')
    <h2 class="text-center mb-5">Create New Recipe</h2>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="form-group">
                    <label for="title">Title Recipe</label>

                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Title Recipe" value="{{ old('title') }}">

                    @error('title')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>              
                    @enderror
                </div>

                <div class="from-group mt-3">
                    <label for="categories">Categories</label>

                    <select name="category" class="form-select @error('category') is-invalid @enderror" id="category">
                        <option value="">-- Select --</option>
                        @foreach($categories as $id => $category)
                            <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>

                    @error('category')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span> 
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="preparation">Preparation</label>
                    <input type="hidden" id="preparation" name="preparation" value="{{ old('preparation') }}">
                    <trix-editor class="form-control @error('preparation') is-invalid @enderror" input="preparation"></trix-editor>

                    @error('preparation')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span> 
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="ingredients">Ingredients</label>
                    <input type="hidden" id="ingredients" name="ingredients" value="{{ old('ingredients') }}">
                    <trix-editor class="form-control @error('ingredients') is-invalid @enderror" input="ingredients"></trix-editor>

                    @error('ingredients')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span> 
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="image">Choose the image</label>
                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image">

                    @error('image')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span> 
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <input type="submit" class="btn btn-primary" value="Add Recipe">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" defer></script>
@endsection