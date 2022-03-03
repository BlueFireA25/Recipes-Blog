<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Models\CategoryRecipe;

class CategoriesController extends Controller
{
    public function show(CategoryRecipe $categoryRecipe) 
    {
        $recipes = Recipe::where('category_id', $categoryRecipe->id)->paginate(3);
        return view('categories.show', compact('recipes', 'categoryRecipe'));
    }
}