<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $table = 'recipe';
    public function components(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Component::class,'recipe_id');
    }
    public function getAuthorUrl(): string
    {
        return '/recipeauthor/'.Recipeauthor::findOrFail($this->author)->id;
    }
    public function getAuthorTitle(): string
    {
        return Recipeauthor::findOrFail($this->author)->title;
    }
    public function getRecipeType(): string
    {
        return Recipetype::findOrFail($this->type)->title;
    }

    public function getSamComponents(): array
    {
        $components =[];
        foreach ($this->components as $item){

            $item->product = Product::findOrFail($item->product_id);
            $item->measure = Measure::findOrFail($item->measure_id);
            $components[] =$item;
        }
        return $components;
    }

}
