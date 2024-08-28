<div class="modal fade in" id="search_product_modal" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="search_product_form" id="search_product_form" action="" method="post" >
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('lang.add_product_to_client')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group m-form__group row">
                        <div class="col-md-12">
                            <label for="product_id">{{trans('lang.product')}}</label>
                            <select name="product_id" class="product_search form-control">
                                <option value="">{{trans('lang.product')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-black px-5 text-white btn_save_page">{{trans('lang.save')}}</button>
                    <button type="button" class="btn btn-secondary px-5" data-dismiss="modal">{{trans('lang.hide')}}</button>
                </div>
                <input type="hidden" name="hidden" class="rowIdUpdate" value="0">
                <div id="loading">
                    <img id="loading-image" src="/admin-assets/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).on('click','.btn_add_product_to_client',function(e){
        e.preventDefault();
        $('.search_product_form .product_search').html('<option value="">{{trans("lang.product")}}</option>');
        $('#search_product_modal').modal('show');
    });
    
</script>
<script>
    $('.search_product_form').on('submit', function(e){
           e.preventDefault();
           $('#add_product_modal #loading').show();
           var formData = new FormData(this);
           var client_id = $('.client_id').val();
           formData.set('client_id',client_id);
           $.ajax({
               url: "{{route('admin.products.add_to_client')}}",
               type: "post",
               cache:false,
               contentType: false,
               processData: false,
               data: formData,
               success: function (data) {
                   $('#add_product_modal #loading').hide();
                   if (data["status"] == true) {
                       swal({
                           title: "",
                           text: data["data"],
                           type: "success",
                           showCancelButton: false,
                           confirmButtonColor: "#DD6B55",
                           confirmButtonText: "{{__('lang.ok')}}",
                           cancelButtonText: "{{__('lang.cancel')}}",
                           closeOnConfirm: true,
                           closeOnCancel: true
                       });
                       var option = '';
                       if(data.product){
                            option += '<option value="'+data.product.id+'" selected>'+data.product.name+'</option>';
                            $('#product_id').html(option);
                       }
                       $('#search_product_modal').modal('hide');
                   } else {
                       swal({
                           title: "",
                           text: data["data"],
                           type: "error",
                           showCancelButton: false,
                           confirmButtonColor: "#DD6B55",
                           confirmButtonText: "{{__('lang.ok')}}",
                           cancelButtonText: "{{__('lang.cancel')}}",
                           closeOnConfirm: true,
                           closeOnCancel: true
                       });
                   }
               }
           });
    });

    $(".search_product_form .product_search").select2({
        minimumInputLength: 2,
        ajax: {
            url: "{{route('admin.products.select')}}",
            dataType: 'json',
            delay: 250,
            type: "get",
            data: function (term) {
                return {
                    term: term.term
                };
            },
            processResults: function (response) {
                if(response){
                return {
                    results:response
                };
                }
            },
            cache: true
        }
    });
</script>