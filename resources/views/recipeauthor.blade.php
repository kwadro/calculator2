@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="title text-center  mb-2 px-4 py-2">
                <span class="text-uppercase fs-3 fw-bold">{{ __('admin.recipe_list_title') }} {{__($recipes[0]->getAuthorTitle())}}</span>
            </div>
        </div>
    </div>
    @if(isset($recipes))
        <div class="container d-flex ">
        @foreach($recipes as $recipe )
                <a href="/recipe/{{$recipe->id}}">
                        <div class="col-12">
                            <img src="/uploads/{{$recipe->image}}" alt="{{$recipe->name}}" width="100%" />
                        </div>
                        <div class="col-12 text-center">
                            {{$recipe->name}}
                        </div>
                </a>
        @endforeach
        </div>
    @endif
@endsection
