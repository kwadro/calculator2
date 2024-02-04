<?php

namespace App\Models;

class RecipeService
{
    public function getProductsByIdAndQty($products, $recipeId, $recipeQty = 1)
    {
        $components = Recipe::find($recipeId)->components;
        foreach ($components as $component) {
            $product = Product::find($component->product_id);
            if (!isset($products[$product->category])) {
                $products[$product->category] = [];
            }
            if (!isset($result[$product->category][$product->id])) {
                $category = Category::find($product->category);
                $measure = Measure::find($component->measure_id)->title;
                $products[$product->category][$product->id] =
                    [
                        'image' => $product->image,
                        'name' => $product->name,
                        'price' => $product->price,
                        'category' => $category->title,
                        'qty' => 0,
                        'measure' => $measure,
                        'total' => 0,
                        'cat_url' => '/category/'.$category->id,
                        'product_url' => '/product/'.$product->id
                    ];
            }
            $qty = $recipeQty * $component->qty;
            $products[$product->category][$product->id]['qty'] += $qty;
            $total = $product->price * $qty;
            $products[$product->category][$product->id]['total'] += $total;
        }
        return $products;
    }
}
