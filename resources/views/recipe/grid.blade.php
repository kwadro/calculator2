@if(isset($recipes) && count($recipes)>0)
    <div class="container">
        <div class="row">
            @foreach($recipes as $recipe )
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                <a href="/recipe/{{$recipe->id}}">
                    <img src="/uploads/{{$recipe->image}}" alt="{{$recipe->name}}" width="100%" />
                    <div class="col-12 text-center">
                        {{$recipe->name}}
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
@else
    <div class="container">
        <div class="row">
            {{__('admin.recipe_not_found')}}
        </div>
    </div>
@endif
