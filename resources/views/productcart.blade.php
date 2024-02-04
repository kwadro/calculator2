@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="title d-flex justify-content-between rounded border text-white bg-secondary mb-2 px-4 py-2">
                <span class="text-uppercase fs-3 fw-bold">{{ __('admin.product_cart_link') }}</span>
            </div>
        </div>
    </div>
    @if($recipes && $recipeQty)
        @include('recipe.subtitle',['subtitle'=>__('admin.recipe_list_sub_title')])
        @foreach($recipes as $recipe)
            <form id="update_recipe-{{$recipe->id}}" method="post" action="{{ route('productcartupdate') }}" novalidate>
                @csrf
                <div class="row my-1">
                    <div class="col-5 d-flex align-items-center">
                        <a href="/recipe/{{$recipe->id}}">
                            {{$recipe->name}}
                        </a>
                    </div>
                    <div class="col-2 text-center">
                        <input class="form-control col-2 text-center" type="number"
                            name="recipes[{{$recipe->id}}]"
                            id="recipe_number_{{$recipe->id}}"
                            value="{{$recipeQty[$recipe->id]}}"/>
                    </div>
                    <div class="col-2  text-center ">
                        <button id="recipe_button_{{$recipe->id}}" class="d-none btn btn-primary" type="submit">{{__('admin.save_recipe_count')}}</button>
                    </div>
                </div>
            </form>
        @endforeach
    @else
        @include('recipe.message',['message'=>__('admin.select_product_empty')])
    @endif
    @if($products && $recipes && $recipeQty)
        @include('recipe.subtitle',['subtitle'=>__('admin.product_list_sub_title')])
        @foreach($products as $categoryId=>$productItems)
            @foreach($productItems as $product)
            <div class="row">
                <div class="col-5 border">
                    {{$product['name']}}
                </div>
                <div class="col-1 border">
                    {{$product['qty']}}
                </div>
                <div class="col-1 border">
                    {{$product['measure']}}
                </div>
            </div>
            @endforeach
        @endforeach
    @endif
@endsection
@section('footer-scripts')
    @include('scripts.cart-script')
@endsection



