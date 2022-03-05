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
    <h1 class="text-center">Edit profile</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-white p-3">
            <form action="{{ route('profiles.update', ['profile' => $profile->id ]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>

                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Your name" value="{{ $profile->user->name }}">

                    @error('name')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>              
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="webpage">Webpage</label>

                    <input type="text" name="webpage" class="form-control @error('webpage') is-invalid @enderror" id="webpage" placeholder="Your webpage" value="{{ $profile->user->webpage }}">

                    @error('webpage')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>              
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="biography">Biography</label>
                    <input type="hidden" id="biography" name="biography" value="{{ $profile->biography }}">
                    <trix-editor class="form-control @error('biography') is-invalid @enderror" input="biography"></trix-editor>

                    @error('biography')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span> 
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="image">Your image <b> (This is a test image, as heroku does not store the images) </b> </label>
                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                    
                    @if( $profile->image )
                        <div class="mt-4">
                            <p>Current Image:</p>
                            <img src="/images/profile_demo.png" alt="Recipe Image" width="300px">
                            {{-- <img src="/storage/{{ $profile->image }}" alt="Recipe Image" width="300px"> --}}
                        </div>

                        @error('image')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span> 
                        @enderror
                    @endif 
                </div>

                <div class="form-group mt-3">
                    <input type="submit" class="btn btn-primary" value="Edit Profile">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" defer></script>
@endsection