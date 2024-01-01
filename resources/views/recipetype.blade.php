@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="title text-center  mb-2 px-4 py-2">
                <span class="text-uppercase fs-3 fw-bold">{{ __('admin.recipe_type_list_title') }} {{__($recipes[0]->getRecipeType())}}</span>
            </div>
        </div>
    </div>
    @if(isset($recipes))
        <div class="container">
            <div class="row">
                @for($i=0;$i<count($recipes);$i++)
                     <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                         <a href="/recipe/{{$recipes[$i]->id}}">
                             <img src="/uploads/{{$recipes[$i]->image}}" alt="{{$recipes[$i]->name}}" width="100%"/>
                             <div class="col-12 text-center">
                                 {{$recipes[$i]->name}}
                             </div>
                         </a>
                     </div>
                @endfor
            </div>
        </div>
    @endif
@endsection
