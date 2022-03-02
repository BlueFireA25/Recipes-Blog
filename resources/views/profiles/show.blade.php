@extends('layouts.app')

@section('buttons')
    <a href="{{ route('recipes.index') }}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
        <i class="bi bi-caret-left-fill"></i> Go Back
    </a>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                @if( $profile->image )
                    <img src="/storage/{{ $profile->image }}" class="w-75 h-75 rounded-circle" alt="Profile image">
                @endif
            </div>
            <div class="col-md-7 mt-5 mt-md-0">
                <h2 class="text-center mb-2 text-primary">{{ $profile->user->name }}</h2>
                <a href="{{ $profile->user->webpage }}" target="_blank">Visit website</a>
                <div class="biography">
                    {!! $profile->biography !!}
                </div>

            </div>
        </div>
    </div>

    <h2 class="text-center my-5">Recipes created by: {{ $profile->user->name }}</h2>
    <div class="container">
        <div class="row mx-auto bg-white p-4">
            @if( count($recipes) > 0 )
                @foreach($recipes as $recipe)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="/storage/{{ $recipe->image }}" class="card-img-top" alt="Recipe image">
                            <div class="card-body">
                                <h3>{{ $recipe->title }}</h3>
                                <a href="{{ route('recipes.show', ['recipe' => $recipe->id]) }}" class="btn btn-primary d-block mt-4 text-uppercase font-weight-bold">View Recipe</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center w-100">No recipes yet...</p>
            @endif
        </div>
        
        <div class="col-12 mt-4 justify-content-center d-flex">
            {{ $recipes->links() }}
        </div>
    </div>
@endsection