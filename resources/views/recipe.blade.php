@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="title text-center  mb-2 px-4 py-2">
                <span class="text-uppercase fs-3 fw-bold">{{ __($recipe->name) }}</span>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="text-center col-xs-4 col-md-4 col-sm-4 col-xs-12 mb-md-2 px-md-4 py-md-2 mb-0 px-0 py-0">
                <span class="fs-5 fw-bold">{{ __('admin.category') }}</span>
                <a href="/recipetype/{{$recipe->type}}">
                    <span class="fs-5 fw-bold"> {{ __($recipe->getRecipeType()) }}</span>
                </a>
            </div>
            @if($recipe->cook_time)
                <div class="text-center col-xs-4 col-md-4 col-sm-4 col-xs-12 mb-md-2 px-md-4 py-md-2 mb-0 px-0 py-0">
                    <span class="fs-5 fw-bold">{{ __('admin.cooking_time') }}</span>
                    <span class="fs-5 fw-bold">{{$recipe->cook_time}} {{ __('admin.cooking_time_measure') }}</span>
                </div>
            @endif
            @if($recipe->author)
                <div class="text-center col-xs-4 col-md-4 col-sm-4 col-xs-12mb-2 px-xs-4 py-xs-2 px-0 py-0">
                    <span class="fs-5 fw-bold">{{ __('admin.author') }}</span>
                    <a href="{{$recipe->getAuthorUrl()}}">
                        <span class="fs-5 fw-bold"> {{$recipe->getAuthorTitle()}} </span>
                    </a>
                </div>
            @endif
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 mt-2">
                <img width="100%" src="/uploads/{{$recipe->image}}" alt="{{$recipe->name}}"/>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 mt-2">
                @foreach($recipe->getSamComponents() as $component)
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div  class="row">
                                <div class="col-md-9 col-sm-7 col-xs-12">{{$component->product->name}}</div>
                                <div class="col-md-2 col-sm-3 col-xs-12 ">{{$component->qty}}{{$component->measure->title}}</div>
                            </div>
                        </li>
                    </ul>
                @endforeach
            </div>
        </div>
    </div>
    @auth
        @if(isset($recipe->id))
            <form id="add-to-cart" method="post" action="{{ route('add_to_cart_form') }}" novalidate>
            @csrf
            <input type="hidden" name="recipe_id" value="{{$recipe->id}}"/>
            <button class="mt-3 btn btn-primary px-5" type="submit">{{__('admin.add-to-cart')}}</button>
        </form>
        @endif
    @endauth
@endsection

