<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Models\CategoryRecipe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecipeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'search']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $recipes = auth()->user()->recipes;

        $user = auth()->user();

        // Recipes with pagination
        $recipes = Recipe::where('user_id', $user->id)->paginate(2);

        return view('recipes.index')
            ->with('recipes', $recipes)
            ->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Categories in DB (no models)
        //$categories = DB::table('categories_recipes')->get()->pluck('name', 'id');

        // Categories in DB (models)
        $categories = CategoryRecipe::all(['id', 'name']);

        return view('recipes.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => 'required|min:6',
            'category' => 'required',
            'preparation' => 'required',
            'ingredients' => 'required',
            'image' => 'required|image'
        ]);

        // Get image path
        $route_image = $request['image']->store('upload-recipes', 'public');

        // Resize image
        // $img = Image::make(public_path("/storage/{$route_image}"))->fit(1000, 550);
        // $img->save();

        // Store in DB (no models)
        // DB::table('recipes')->insert([
        //     'title' => $data['title'],
        //     'ingredients' => $data['ingredients'],
        //     'preparation' => $data['preparation'],
        //     'image' => $route_image,
        //     'user_id' => Auth::user()->id,
        //     'category_id' => $data['category']
        // ]);

        // Store in DB (with odels)
        auth()->user()->recipes()->create([
            'title' => $data['title'],
            'ingredients' => $data['ingredients'],
            'preparation' => $data['preparation'],
            'image' => $route_image,
            'category_id' => $data['category']
        ]);

        // Redirect
        return redirect()->route('recipes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        // Get if the current user likes the recipe is authenticated
        $like = (auth()->user()) ? auth()->user()->iLike->contains($recipe->id) : false;

        // Pass the amount of likes to the visit
        $likes = $recipe->likes->count();

        return view('recipes.show', compact('recipe', 'like', 'likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        // Run the Policy
        $this->authorize('view', $recipe);

        // Categories in DB (models)
        $categories = CategoryRecipe::all(['id', 'name']);

        return view('recipes.edit', compact('categories', 'recipe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {

        // Review policy
        $this->authorize('update', $recipe);

        // Validation
        $data = request()->validate([
            'title' => 'required|min:6',
            'category' => 'required',
            'preparation' => 'required',
            'ingredients' => 'required',
        ]);

        // Set Values
        $recipe->title = $data['title'];
        $recipe->category_id = $data['category'];
        $recipe->preparation = $data['preparation'];
        $recipe->ingredients = $data['ingredients'];

        // If the user uploads a new image
        if($request['image']) 
        {
            // Get image path
            $route_image = $request['image']->store('upload-recipes', 'public');
            
            // Assign to object
            $recipe->image = $route_image;
        }

        $recipe->save();

        // Redirect
        return redirect()->route('recipes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        // Run the Policy
        $this->authorize('delete', $recipe);

        // Delete recipe
        $recipe->delete();

        return redirect()->route('recipes.index');
    }

    public function search(Request $request) 
    {
        $search = $request->get('search');
        
        $recipes = Recipe::where('title', 'like', '%' . $search . '%')->paginate(10);
        $recipes->appends(['search' => $search]);

        return view('searches.show', compact('recipes', 'search'));
    }
}
