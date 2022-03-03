@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('hero')
    <div class="hero-categories">
        <form class="container h-100" action="{{ route('search.show') }} ">
            <div class="row h-100 align-items-center">
                <div class="col-md-4 text-search">
                    <p class="display-4">
                        Find a recipe for your next meal
                    </p>
                    <input type="search" name="search" class="form-control" placeholder="Search Recipe">
                </div>
            </div>
        </form>
    </div>
@endsection

@section('content')

    <div class="container news-recipes">
        <h2 class="title-category text-uppercase mb-4">Latest recipes</h2>
    
        <div class="owl-carousel owl-theme">
            @foreach($newsRecipes as $newRecipe)
                <div class="card">
                    <img src="/storage/{{ $newRecipe->image }}" alt="Recipe Image" class="card-img-top">
                    
                    <div class="card-body">
                        <h3>{{ Str::title($newRecipe->title) }}</h3>

                        <p>{{ Str::words(strip_tags($newRecipe->preparation), 15) }}</p>

                        <a href="{{ route('recipes.show', ['recipe' => $newRecipe->id]) }}" class="btn btn-primary d-block font-weight-bold text-uppercase">View Recipe</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container">
        <h2 class="title-category text-uppercase mt-5 mb-4">Most voted recipes</h2>
    
        <div class="row">
            @foreach($voted as $recipe)
                @include('ui.recipe')
            @endforeach
        </div>
    </div>

    @foreach($recipes as $key => $group)
        <div class="container">
            <h2 class="title-category text-uppercase mt-5 mb-4">{{ str_replace('-', ' ', $key) }}</h2>
        
            <div class="row">
                @foreach ($group as $recipes)
                    @foreach($recipes as $recipe)
                        @include('ui.recipe')
                    @endforeach
                @endforeach
            </div>
        </div>
    @endforeach
@endsection