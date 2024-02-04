<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Recipe;
use App\Models\RecipeService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductCartController extends Controller
{
    private RecipeService $recipeService;

    public function __construct(
        RecipeService $recipeService
    )
    {
        $this->middleware('auth');
        $this->recipeService = $recipeService;
    }

    public function addItem(Request $request)
    {
        $recipeId = $request->recipe_id;
        $user = Auth::user();
        $sessionKey = 'recipecart_'.$user->id;
        if ($request->session()->has($sessionKey)) {
            $recipeIds = json_decode($request->session()->get($sessionKey),true);
            $recipeIds[] = $recipeId;
        }else{
            $recipeIds =[$recipeId];
        }
        $request->session()->put($sessionKey, json_encode($recipeIds));
        return redirect()->back()->with('success', 'Success for save');
    }
    public function deleteItem(Request $request)
    {

    }
    public function clearAllItem(Request $request)
    {

    }
    public function update(Request $request)
    {
        if ($request->isMethod('post')) {
            return response()->json(['success'=>'Data is successfully update']);
        }

    }

    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            return response()->json(['success'=>'Data is successfully update']);
        }
        $user = Auth::user();
        $recipeIds = json_decode($request->session()->get('recipecart_'.$user->id),true);

        if (!$recipeIds){
            return view('productcart',['recipes'=>null,'products'=>null]);
        }else{
            $recipes = Recipe::all()->filter(function($item) use ($recipeIds) {
                return in_array($item->id,$recipeIds);
            });
            $recipeQty=[];
            foreach ($recipeIds as $recipeId) {
                if (!isset($recipeQty[$recipeId])){
                    $recipeQty[$recipeId]=0;
                }
                $recipeQty[$recipeId]++;
            }
            $products = [];
            // load duplicate ids and  added qty
            foreach ($recipeIds as $recipeId) {
                $products = $this->recipeService->getProductsByIdAndQty(
                    $products,
                    $recipeId,
                    $recipeQty[$recipeId]
                );
            }
            return view('productcart',['recipeQty'=>$recipeQty,'recipes'=>$recipes,'products'=>$products]);
        }
    }
}
