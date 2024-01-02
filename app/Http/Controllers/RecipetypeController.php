<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Recipetype;
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
            if (count($recipes)>0){
                return view('recipetype',['recipes'=>$recipes]);
            }else{
                return view('recipetype',['type'=>Recipetype::find($type)]);
            }
        }

        return redirect(route('404'));

    }
}
