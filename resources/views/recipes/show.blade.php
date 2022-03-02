@extends('layouts.app')

@section('buttons')
    <a href="{{ route('recipes.index') }}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
        <i class="bi bi-caret-left-fill"></i> Go Back
    </a>
@endsection

@section('content')
    <article class="content__recipe">
        <h1 class="text-center mb-4">{{ $recipe->title }}</h1>

        <div class="image__recipe">
            <img src="/storage/{{ $recipe->image }}" alt="Recipe Image" class="w-100">
        </div>

        <div class="recipe__goal">
            <p>
                <span class="font-weight-bold text-primary">Written in:</span>
                {{ $recipe->category->name }}
            </p>

            <p>
                <span class="font-weight-bold text-primary">Author:</span>
                {{ $recipe->author->name }}
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
        </div>
    </article>
@endsection