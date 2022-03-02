<a href="{{ route('recipes.create') }}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
    <i class="bi bi-person-circle"></i> New Recipe
</a>
<a href="{{ route('profiles.edit', ['profile' => Auth::user()->id]) }}" class="btn btn-outline-success mr-2 text-uppercase font-weight-bold">
    <i class="bi bi-pen-fill"></i> Edit Profile
</a>
<a href="{{ route('profiles.show', ['profile' => Auth::user()->id]) }}" class="btn btn-outline-info mr-2 text-uppercase font-weight-bold">
    <i class="bi bi-eye-fill"></i> View profile
</a>