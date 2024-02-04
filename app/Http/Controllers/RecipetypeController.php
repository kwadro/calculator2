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
            $title =  __('admin.recipe_type_list_title');
            if (count($recipes)>0){
                $title.= " ". __($recipes[0]->getRecipeType());
                return view('recipegroup',['title'=>$title,'recipes'=>$recipes]);
            }else{
                $type = Recipetype::find($type);
                $title.= " ". __($type->title);
                return view('recipegroup',[ 'title'=>$title,'recipes'=>null]);
            }
        }
        return redirect(route('404'));
    }
}
