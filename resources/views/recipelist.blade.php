@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="title text-center  mb-2 px-4 py-2">
                <span class="text-uppercase fs-3 fw-bold">{{ __('admin.recipe_types_title') }} </span>
            </div>
        </div>
    </div>
    @if(isset($typeslist))
        <div class="container">
            <div class="row">
                @foreach($typeslist as $type )
                <a class="col-4" href="/recipetype/{{$type->id}}">
                        @if($type->image)
                            <img src="/uploads/{{$type->image}}" alt="{{$type->title}}" width="100%" />
                        @endif
                        <div class="text-center">
                            {{$type->title}}
                        </div>
                </a>
        @endforeach
            </div>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="title text-center  mb-2 px-4 py-2">
                <span class="text-uppercase fs-3 fw-bold">{{ __('admin.recipe_authors_title') }} </span>
            </div>
        </div>
    </div>
    @if(isset($authorslist))
        <div class="container">
            <div class="row">
            @foreach($authorslist as $author )
                <a class="col-4" href="/recipeauthor/{{$author->id}}">
                    @if($author->image)
                            <img src="/uploads/{{$author->image}}" alt="{{$author->title}}" width="100%" />
                    @endif
                    <div class="text-center">
                        {{$author->title}}
                    </div>
                </a>
            @endforeach
            </div>
        </div>
    @endif
@endsection
