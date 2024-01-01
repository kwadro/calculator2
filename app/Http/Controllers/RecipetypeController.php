<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipetypeController extends Controller
{
    public function index(Request $request)
    {
        $type =$request->type;

        if($type){
            $recipes = Recipe::all()->sortBy('name')->filter(function ($recipe) use ($type) {
                return $recipe->type === $type;
            })->values();
            if ($recipes){
                return view('recipetype',['recipes'=>$recipes]);
            }
        }

        return redirect(route('404'));

    }
}
