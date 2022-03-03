@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="title-category text-uppercase mb-4">Category: {{ $categoryRecipe->name }} </h2>
        
        <div class="row">
            @foreach($recipes as $recipe)
                @include('ui.recipe')
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $recipes->links() }} 
        </div>
    </div>
@endsection