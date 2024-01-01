<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Fectiverecipe;
use App\Models\Festive;
use App\Models\FestiveResult;
use App\Models\Measure;
use App\Models\Product;
use App\Models\Recipe;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FestiveController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $user = Auth::user();
        $collection = Festive::all();
        $festiveCollection = $collection->filter(function ($item) use ($user) {
            return $item->user_id === $user->id;
        })->values();
        return view('home', ['user' => $user, 'festives' => $festiveCollection, 'formFestive' => null]);
    }

    public function index(Request $request)
    {
        $festiveId = $request->route('festive_id');
        $user = Auth::user();
        $festiveCollection = Festive::all()->filter(function ($item) use ($user) {
            return $item->user_id === $user->id;
        })->values();
        $festiveCollectionLib = Festive::all()->filter(function ($item) use ($user) {
            return $item->user_id === 0;
        })->values();
        $formFestive = Festive::find($festiveId);
        $recipesCollection = Recipe::all()->values();
        $selectRecipes = $formFestive->recipes;
        $selectRecipesValues = [];
        foreach ($selectRecipes as $selectRecipe) {
            $selectRecipesValues[$selectRecipe->recipe_id] = $selectRecipe->qty;
        }
        $productList = FestiveResult::all()->filter(function ($item) use ($user, $festiveId) {
            return ($item->user_id === $user->id) && ((int)$festiveId === $item->festive_id);
        })->values();

        if ($recipesCollection && $formFestive && $user->id === $formFestive->user_id) {
            return view(
                'home',
                [
                    'productList' => $productList,
                    'selectRecipes' => $selectRecipesValues,
                    'recipes' => $recipesCollection,
                    'user' => $user,
                    'festivesLib' => $festiveCollectionLib,
                    'festives' => $festiveCollection,
                    'formFestive' => $formFestive
                ]
            );
        }

        return redirect(route('festiveform'))->with('error', 'Please  create new value');
    }

    public function festive(Request $request)
    {
        $step = (int)$request->step;
        if ($step === 1) {
            return $this->saveBaseInfo($request);
        }
        if ($step === 2) {
            return $this->saveRecipes($request);
        }
        if ($step === 3) {
            return $this->saveResult($request);
        }
    }

    public function saveBaseInfo(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'count_people' => 'required',
            'description' => 'required',
            'name' => 'required',
            'date' => 'required',
        ]);
        $festiveId = $request->festive_id;
        if ($festiveId) {
            $festive = Festive::find($festiveId);
        } else {
            $festive = new Festive();
        }
        $user = Auth::user();

        $festive->count_people = $request->count_people;
        $festive->step = 1;
        $festive->user_id = $user->id;
        $festive->name = $request->name;
        $festive->description = $request->description;
        $festive->date = $request->date;
        $festive->save();
        //Toastr::success('Festive data Successfully Saved','Success');
        return redirect("/festive/$festiveId#step-1")->with('success', 'Festive data Successfully Saved');
    }

    public function saveRecipes(Request $request)
    {
        $festiveId = $request->festive_id;
        if ($festiveId) {
            $festive = Festive::find($festiveId);
            if ($festive) {
                $user = Auth::user();
                if ($user->id === $festive->user_id) {
                    $festiveRecipes = $request->recipes;
                    $festiveRecipesList = Fectiverecipe::all()->filter(function ($item) use ($festive) {
                        return $festive->id === $item->festive_id;
                    })->values();
                    foreach ($festiveRecipesList as $festiveRecipe) {
                        $festiveRecipe->delete();
                    }
                    foreach ($festiveRecipes as $recipeId => $festiveRecipe) {
                        if (isset($festiveRecipe['recipe_id'])
                            && $festiveRecipe['recipe_id'] === 'on'
                            && $festiveRecipe
                            && (int)$festiveRecipe['qty'] > 0) {
                            $festiveRecipeObject = new Fectiverecipe();
                            $festiveRecipeObject->recipe_id = $recipeId;
                            $festiveRecipeObject->qty = $festiveRecipe['qty'];
                            $festiveRecipeObject->user_id = $user->id;
                            $festiveRecipeObject->festive_id = $festiveId;
                            $festiveRecipeObject->save();
                        }
                    }
                    $festive->step = 2;
                    $festive->save();
                    $festiveId =$festive->id;
                    return redirect("/festive/$festiveId#step-2")->with('success-2', 'Recipes in Festive data Successfully Saved');
                }
            }
        }
        return redirect()->back()->with('error', 'We haven\'t access  for save');
    }

    public function saveResult(Request $request)
    {
        $festiveId = $request->festive_id;
        if ($festiveId) {
            $festive = Festive::find($festiveId);
            if ($festive) {
                $user = Auth::user();
                if ($user->id === $festive->user_id) {
                    // remove  old calculation
                    $festiveResults = FestiveResult::all()->filter(function ($item) use ($user, $festive) {
                        return ($festive->id === $item->festive_id) && ($item->user_id === $user->id);
                    })->values();
                    foreach ($festiveResults as $item){
                        $item->delete();
                    }
                    // list  recipe for festive
                    $festiveRecipesList = Fectiverecipe::all()->filter(function ($item) use ($festive) {
                        return $festive->id === $item->festive_id;
                    })->values();
                    $result = [];
                    foreach ($festiveRecipesList as $festiveRecipe) {
                        $components = Recipe::find($festiveRecipe->recipe_id)->components;
                        foreach ($components as $component) {
                            $product = Product::find($component->product_id);
                            if (!isset($result[$product->category])) {
                                $result[$product->category] = [];
                            }
                            if (!isset($result[$product->category][$product->id])) {
                                $category = Category::find($product->category)->title;
                                $measure = Measure::find($component->measure_id)->title;
                                $result[$product->category][$product->id] =
                                    [
                                        'image' => $product->image,
                                        'name' => $product->name,
                                        'price' => $product->price,
                                        'category' => $category,
                                        'qty' => 0,
                                        'measure' => $measure,
                                        'total' => 0,
                                    ];
                            }
                            $qty = $festiveRecipe->qty * $component->qty;
                            $result[$product->category][$product->id]['qty'] += $qty;
                            $total = $product->price * $qty;
                            $result[$product->category][$product->id]['total'] += $total;
                        }
                    }
                    foreach ($result as $categoryId => $item) {
                            foreach ($item as $productId => $prodItem) {
                                $prodItem['cat_url'] = '/category/'.$categoryId;
                                $prodItem['product_url'] = '/product/'.$productId;
                                $prodItem['festive_id'] = $festiveId;
                                $prodItem['user_id'] = $user->id;
                                $festiveResult= new FestiveResult();
                                $festiveResult->fill($prodItem);
                                $festiveResult->save();
                            }
                        }

                    $festive->step = 3;
                    $festive->save();
                    return redirect("/festive/$festiveId#step-3")->with('success-3', 'Calculate products Successfully Saved');
                }
            }
        }
        return redirect()->back()->with('error', 'We haven\'t access  for save');
    }
}
