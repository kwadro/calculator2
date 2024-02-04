<script type="module">
    $(document).ready(function(){
        console.log('document ready');
    });

    $(document).ready(function(){
        const recipeSelector= "input[id*='recipe_number_']";
        $(document).on('click',recipeSelector,function (element){
            console.log('click id : ',$(this).attr('id'));
            const idButtonSelector = '#recipe_button_' + $(this).attr('id').replace('recipe_number_','');
            console.log('idButtonSelector',idButtonSelector);
            console.log('idButtonSelector length',$(idButtonSelector).length);
            $(idButtonSelector).removeClass('d-none');
        });
        const buttonSelector= "button[id*='recipe_button_']";
        $(document).on('click',buttonSelector,function (element){
            const self =this;
            $.ajaxSetup({
                headers: {
                    'X-CSSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url : "{{ url('productcart') }}",
                cache: false,
                contentType: false,
                processData: false,
                success : function (data) {
                    console.log('data : ',data)
                    //$("#res-update").html(data);
                    $(self).addClass('d-none')
                }
            });
        });
    });
</script>
