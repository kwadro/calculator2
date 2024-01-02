<?php

namespace App\Http\Controllers;

use App\Models\Recipeauthor;
use App\Models\Recipetype;
use Illuminate\Http\Request;

class RecipeListController extends Controller
{
    public function index(Request $request)
    {
        $types =Recipetype::all();
        $authors =Recipeauthor::all();
        if($types){
            return view('recipelist',['authorslist'=>$authors,'typeslist'=>$types]);
        }
        return redirect(route('404'));
    }
}
