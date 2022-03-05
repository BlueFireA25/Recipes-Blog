<div class="col-md-4 mt-4">
    <div class="card shadow">
        <img src="/images/recipe_demo.jpg" alt="Recipe Image" class="card-img-top">
        {{-- <img src="/storage/{{ $recipe->image }}" alt="Recipe Image" class="card-img-top"> --}}
        <div class="card-body">
            <h3 class="card-title">{{ $recipe->title }}</h3>
        
            <div class="meta-recipe d-flex justify-content-between">
                @php
                    $dateRecipe = $recipe->created_at
                @endphp

                <p class="text-primary font-weight-bold">
                    <date-recipe date="{{ $dateRecipe }}"></date-recipe>
                </p>

                <p>
                    {{ count($recipe->likes) }} They like me
                </p>
            </div>

            <p>{{ Str::words( strip_tags($recipe->preparation), 20 ) }}</p>

            <a href="{{ route('recipes.show', ['recipe' => $recipe->id]) }}" class="btn btn-primary d-block btn-recipe">View Recipe</a>
        </div>
    </div>
</div>