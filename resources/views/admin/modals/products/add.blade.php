<div class="modal fade in" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="add_product_form" id="add_product_form" action="" method="post" >
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('lang.add_product')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group m-form__group row">
                        <div class="col-md-12">
                            <label>{{trans('lang.name')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="name" id="name" class="form-control name" placeholder="{{trans('lang.name')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-md-6 col-lg-6">
                            <label for="status">{{trans('lang.product_status')}}</label>
                            <select name="status" class="status form-control" id="status">
                                <option value="">{{trans('lang.product_status')}}</option>
                                <option value="1">{{trans('lang.active')}}</option>
                                <option value="2">{{trans('lang.inactive')}}</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>{{trans('lang.product_id')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="product_id" id="products_id" class="form-control products_id" placeholder="{{trans('lang.product_id')}}">
                            </div>
                        </div>

                    </div>
                    
                    
                    <div class="form-group row">
                        <div class="col-md-12 col-lg-12">
                            <label for="name">{{trans('lang.product_details')}} ({{trans('lang.optional')}})</label>
                            <textarea name="details" id="details" class="details form-control" cols="30" rows="5" placeholder="{{trans('lang.product_details')}}"></textarea>
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <div class="col-md-12 col-lg-12">
                            <input type="checkbox" class="download_update" id="download_update" name="download_update" >
                            <label for="download_update">
                                Make license check compulsory for downloading update
                            </label>
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
    $(document).on('click','.btn_add_product',function(e){
        e.preventDefault();
        $('.add_product_form .name').val('');
        $('.add_product_form .status').val('');
        $('.add_product_form .products_id').val('');
        $('.add_product_form .details').val('');
        $('.add_product_form .download_update').prop('checked',false);
        $('#add_product_modal').modal('show');
    });
    
</script>
<script>
    $('.add_product_form').on('submit', function(e){
           e.preventDefault();
           $('#add_product_modal #loading').show();
           var formData = new FormData(this);
           if($('.download_update').is(':checked')){
               formData.set('download_update',1);
           }else{
               formData.set('download_update',0);
           }
           $.ajax({
               url: "{{route('admin.products.add')}}",
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
                       $('#add_product_modal').modal('hide');
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
    })
</script>