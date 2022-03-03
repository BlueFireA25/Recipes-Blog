<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoryRecipe;

class WelcomeController extends Controller
{
    public function index()
    {
        // Show recipes by number of votes
        $voted = Recipe::withCount('likes')->orderBy('likes_count', 'desc')->take(3)->get();

        // Get the recipes more news
        $newsRecipes = Recipe::latest()->limit(5)->get();

        // Get all categories
        $categories = CategoryRecipe::all();

        // Group recipes by category
        $recipes = [];

        foreach ($categories as $category) {
            $recipes[ Str::slug($category->name) ] [] = Recipe::where('category_id', $category->id)->take(3)->get();
        }

        return view('welcome', compact('newsRecipes', 'recipes', 'voted'));
    }
}
