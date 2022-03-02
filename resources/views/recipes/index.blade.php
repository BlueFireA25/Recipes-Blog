@extends('layouts.app')

@section('buttons')
    @include('ui.navigation')
@endsection

@section('content')
    <h2 class="text-center mb-5">Manage your recipes</h2>

    <div class="col-md-10 mx-auto bg-white p-3">
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th scole="col">Title</th>
                    <th scole="col">Category</th>
                    <th scole="col">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($recipes as $recipe)
                    <tr>
                        <td>{{ $recipe->title }}</td>
                        <td>{{ $recipe->category->name }}</td>
                        <td>
                            <delete-recipe recipe-id={{ $recipe->id }}></delete-recipe>
                            <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-dark d-block mb-2">Edit</a>
                            <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-success d-block mb-2">View</a>
                        </td>
                    </tr>
                @endforeach 
            </tbody>
        </table>

        <div class="col-12 mt-4 justify-content-center d-flex">
            {{ $recipes->links() }}
        </div>
    </div>

@endsection