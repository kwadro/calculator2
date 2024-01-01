<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $recipeId = (int)$request->recipe_id;
        if($recipeId){
            $recipe = Recipe::findOrFail($recipeId);
            if ($recipe){
                return view('recipe',['recipe'=>$recipe]);
            }
        }

        return redirect(route('404'));
    }
}
