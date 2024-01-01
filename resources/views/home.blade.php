@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="title d-flex justify-content-between rounded border text-white bg-secondary mb-2 px-4 py-2">
                <span class="text-uppercase fs-3 fw-bold">{{ __("admin.archive") }}</span>
                <button class="btn btn-secondary  fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#step-0" aria-expanded="false" ></button>
            </div>
        </div>
    </div>
    <div class="container">
        <div id="step-0" class="row">
            <div class="col-6">
                <h2 class="mb-2 px-4">{{ __('admin.your_calc') }}  </h2>
                <ul class="festive-list list">
                    @if(isset($festives) && count($festives))
                        @foreach($festives as $festive)
                            <li class="item">
                                <a class="{{( $formFestive && $festive->id === $formFestive->id ) ? ' active' : ''}}"
                                   href="/festive/{{$festive->id}}"> {{$festive->name}} </a>
                            </li>
                        @endforeach
                    @endif
                    <a class="mt-3 btn btn-primary px-5 {{( !isset($formFestive)) ? ' active' : ''}}" role="button"
                       href="/festive">
                        {{__('admin.new_festive')}}
                    </a>
                </ul>
            </div>
            <div class="col-6">
                <h2 class="mb-2 px-4">{{ __('admin.lib_calc') }}  </h2>
                <ul class="festive-list list">
                    @if(isset($festivesLib) && count($festivesLib))
                        @foreach($festivesLib as $festive)
                            <li class="item">
                                <a class="{{( $formFestive && $festive->id === $formFestive->id ) ? ' active' : ''}}"
                                   href="/festive/{{$festive->id}}"> {{$festive->name}} </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <h1 class="header text-center">{{ __('admin.сalculation_festive') }}  {{(isset($formFestive)) ? $formFestive->name : __('admin.new_item')}} </h1>

    <div class="container">
        <div class="title d-flex justify-content-between rounded border text-white bg-secondary mb-2 px-4 py-2">
            <span class="text-uppercase fs-3 fw-bold">{{ __("admin.base_info") }}</span>
            <button class="btn btn-secondary  fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#step-1" aria-expanded="false" ></button>
        </div>
        @if(Session::has('success'))
            <div class="alert alert-success text-center">
                {{Session::get('success')}}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-error">
                {{ session()->get('error') }}
            </div>
        @endif
        <form id="step-1" method="post" action="{{ route('festiveform') }}" novalidate>
            @csrf
            <input type="hidden" name="step" value="1"/>
            @if(isset($formFestive))
                <input type="hidden" name="festive_id" value="{{$formFestive->id}}"/>
            @endif
            <div class="form-group col-4 mb-2">
                <label>Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                       value="{{isset($formFestive) ? $formFestive->name: old('name')}}"/>
                @error('name')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>

            <div class="form-group col-4 mb-2">
                <label for="description">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                          id="description">{{isset($formFestive) ?$formFestive->description:old('description')}}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
             <strong>{{ $message }}</strong>
        </span>
                @enderror
            </div>
            <div class="form-group col-2 mb-2">
                <label>Date</label>
                <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" id="date"
                       value="{{isset($formFestive) ? $formFestive->date:old('date')}}"/>
                @error('date')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
            <div class="form-group col-1 mb-2">
                <label for="count_people">Count People</label>
                <input type="number" class="form-control @error('count_people') is-invalid @enderror"
                       name="count_people"
                       id="count_people" value="{{isset($formFestive) ? $formFestive->count_people:old('count_people')}}"/>
                @error('count_people')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
            <button class="mt-3 btn btn-primary px-5" type="submit">{{__('admin.save')}}</button>
        </form>
    </div>
    <div class="container mt-3">
        <div class="title d-flex justify-content-between rounded border text-white bg-secondary mb-2 px-4 py-2">
            <span class="text-uppercase fs-3 fw-bold">{{ __('admin.select_recipes') }}</span>
            <button class="btn btn-secondary  fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#step-2" aria-expanded="false"></button>
        </div>
        @if(Session::has('success-2'))
            <div class="alert alert-success text-center">
                {{Session::get('success-2')}}
            </div>
        @endif
        <form id="step-2" method="post" action="{{ route('festiveform') }}" novalidate>
            @csrf
            <input type="hidden" name="step" value="2"/>
            @if(isset($formFestive))
                <input type="hidden" name="festive_id" value="{{$formFestive->id}}"/>
            @endif
            @if(isset($recipes))
                <div class="col-6">
                    <ul class="recipe-list list">
                        @foreach($recipes as $recipe)
                            <li class="item d-flex  align-items-center justify-content-between">
                                <div class="col-9 mb-2 d-flex  align-items-center justify-content-between form-group ">
                                    <span for="recipe_{{$recipe->id}}"><a class=""
                                                                       href="/recipe/{{$recipe->id}}"> {{$recipe->name}} </a></span>
                                    <input type="checkbox" id="recipe_{{$recipe->id}}"
                                       name="recipes[{{$recipe->id}}][recipe_id]" {{($selectRecipes && in_array($recipe->id, array_keys($selectRecipes))) ? 'checked' : ''}}/>
                                </div>
                                <div class="form-group col-2 mb-2">
                                    <input type="number" class="form-control"
                                           name="recipes[{{$recipe->id}}][qty]"
                                           id="recipe_number_{{$recipe->id}}"
                                           value="{{($selectRecipes && isset($selectRecipes[$recipe->id])) ? $selectRecipes[$recipe->id]?:'' : ''}}"/>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <button class="mt-3 btn btn-primary px-5" type="submit">{{__('admin.save')}}</button>
        </form>
    </div>
    <div class="container mt-3">
        <div class="title d-flex justify-content-between rounded border text-white bg-secondary mb-2 px-4 py-2">
            <span class="text-uppercase fs-3 fw-bold">{{ __('admin.list_of_products') }}</span>
            <button class="btn btn-secondary  fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#step-3" aria-expanded="false"></button>
        </div>
        @if(Session::has('success-3'))
            <div class="alert alert-success text-center">
                {{Session::get('success-3')}}
            </div>
        @endif
        <form id="step-3" method="post" action="{{ route('festiveform') }}" novalidate>
            @csrf
            <input type="hidden" name="step" value="3"/>
            @if(isset($formFestive))
                <input type="hidden" name="festive_id" value="{{$formFestive->id}}"/>
            @endif
            <button class="mt-3 btn btn-primary px-5" type="submit">{{(isset($productList)) ? __('admin.recalculate') : __('admin.calculate')}}</button>
        </form>
        @if(isset($productList))
            <div class="col-8 mt-4">
                    @foreach($productList as $product)
                       <div class="row">
                        <div class="col-5 border">
                            {{$product->name}}
                        </div>
                        <div class="col-1 border">
                            {{$product->qty}}
                        </div>
                        <div class="col-1 border">
                            {{$product->measure}}
                        </div>
                       </div>
                    @endforeach
            </div>
        @endif
    </div>
@endsection

