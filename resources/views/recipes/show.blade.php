@extends('layouts.app')

@section('scripts')
    <!-- Heart Button -->
    <script src="{{ asset('js/recipes.js') }}" defer></script>
@endsection

@section('content')
    <article class="content__recipe">
        <h1 class="text-center mb-4">{{ $recipe->title }}</h1>

        <div class="image__recipe">
            <img src="/images/recipe_demo.jpg" alt="Recipe Image" class="w-100">
            {{-- <img src="/storage/{{ $recipe->image }}" alt="Recipe Image" class="w-100"> --}}
        </div>

        <div class="recipe__goal">
            <p>
                <span class="font-weight-bold text-primary">Written in:</span>
                <a class="text-dark" href="{{ route('categories.show', ['categoryRecipe' => $recipe->category->id]) }}">
                    {{ $recipe->category->name }}
                </a>
                
            </p>

            <p>
                <span class="font-weight-bold text-primary">Author:</span>
                <a class="text-dark" href="{{ route('profiles.show', ['profile' => $recipe->author->id]) }}">
                    {{ $recipe->author->name }}
                </a>
            </p>

            <p>
                <span class="font-weight-bold text-primary">Date:</span>
                @php
                    $dateRecipe = $recipe->created_at
                @endphp

                <date-recipe date="{{ $dateRecipe }}"></date-recipe>
            </p>

            <div class="ingredients">
                <h2 class="my-3 text-primary">Ingredients</h2>

                {!! $recipe->ingredients !!}
            </div>

            <div class="ingredients">
                <h2 class="my-3 text-primary">Preparation</h2>

                {!! $recipe->preparation !!}
            </div>

            <div class="justify-content-center row text-center">
                <like-button recipe-id="{{ $recipe->id }}" like="{{ $like }}" likes="{{ $likes }}">
                </like-button>
            </div>

        </div>
    </article>
@endsection