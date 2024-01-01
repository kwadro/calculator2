<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeauthorController extends Controller
{
    public function index(Request $request)
    {
        $author =$request->author;
        if($author){
            $recipes = Recipe::all()->sortBy('title')->filter(function ($recipe) use ($author) {
                return $recipe->author ===$author;
            });
            if ($recipes){
                return view('recipeauthor',['recipes'=>$recipes]);
            }
        }

        return redirect(route('404'));

    }
}
