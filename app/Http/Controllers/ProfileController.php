<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        // Recipes with pagination
        $recipes = Recipe::where('user_id', $profile->user_id)->paginate(2);

        return view('profiles.show', compact('profile', 'recipes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        // Run the Policy
        $this->authorize('view', $profile);

        return view('profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        // Run the Policy
        $this->authorize('update', $profile);

        // Validation
        $data = request()->validate([
            'name' => 'required',
            'webpage' => 'required',
            'biography' => 'required',
        ]);

        // If the user uploads an image
        if($request['image']) 
        {
            // Get image path
            $route_image = $request['image']->store('upload-profiles', 'public');
            
            // Create an image array
            $array_image = ['image' => $route_image];
        }

        // Set Name and Webpage
        auth()->user()->webpage = $data['webpage'];
        auth()->user()->name = $data['name'];
        auth()->user()->save();

        // Delete Name and Webpage
        unset($data['webpage']);
        unset($data['name']);

        // Set Biography and Image
        auth()->user()->profile()->update(array_merge(
            $data, 
            $array_image ?? []
        ));

        // Redirect
        return redirect()->route('recipes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
