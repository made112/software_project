<div class="modal fade in" id="add_page" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="addNewpageForm" id="addNewpageForm" action="" method="post" >
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('lang.email_license_details_client')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                         
                    <div class="form-group m-form__group row">
                        <div class="col-md-12">
                            <label>{{trans('lang.to')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="email" name="to" class="form-control email" placeholder="{{trans('lang.to')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-md-12">
                            <label>{{trans('lang.email_subject')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="email_subject" class="form-control email_subject" placeholder="{{trans('lang.email_subject')}}">
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <input type="checkbox" class="send_contacts d-inline-block" id="send_contacts" name="send_contacts" >
                        <label for="send_contacts">{{trans('lang.send_contacts')}}</label>
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-md-12 mb-3">
                             <button class="btn btn-dark btn-sm text-white btn_sms btn_code" data-code="">{{trans('lang.license_code')}}</button>
                             <button class="btn btn-dark btn-sm text-white btn_sms btn_limit" data-limit="">{{trans('lang.use_limit')}}</button>
                             <button class="btn btn-dark btn-sm text-white btn_sms btn_date" data-date="">{{trans('lang.license_expiration_date')}}</button>
                        </div>
                        <div class="col-md-12">
                            <label for="recipient-name" class="form-control-label">{{trans('lang.message')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <textarea  name="message" id="message" class="form-control  message ckeditor" placeholder="{{trans('lang.message')}}" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer justify-content-center">
                    <button onClick="CKupdate();" type="submit" class="btn btn-black px-5 text-white btn_save_page">{{trans('lang.save')}}</button>
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
    function CKupdate(){
	    for ( instance in CKEDITOR.instances )
		    CKEDITOR.instances[instance].updateElement();
    }
    $(document).on('click','.send_mail',function(e){
        var id = $(this).data('id');
        var code = $(this).data('code');
        var date = $(this).data('date');
        var limit = $(this).data('limit');
        var email = $(this).data('email');
        e.preventDefault();
        $('.email').val('');
        $('.email_subject').val('');
        CKEDITOR.instances['message'].setData('');
        $('.send_contacts').prop('checked', false);
        $('.rowIdUpdate').val(id);
        $('.email').val(email);
        $('.btn_code').attr('data-data',code);
        $('.btn_limit').attr('data-data',limit);
        $('.btn_date').attr('data-data',date);
        $('#add_page').modal('show');   
    });

    $(document).on('click','.btn_sms',function(e){
        e.preventDefault();
        var data = '<span>'+$(this).data('data')+'</span>';
        CKEDITOR.instances.message.insertHtml(data);
    });
</script>
<script>
        $('.addNewpageForm').on('submit', function(e){
            e.preventDefault();
            $('#add_page #loading').show();
			var formData = new FormData(this);
            var send_contacts = 0;
            if ($('input.send_contacts').is(':checked')) {
                send_contacts = 1;
            }
            formData.set('send_contacts',send_contacts);
            $.ajax({
                url: "{{route('admin.licenses.send_mail')}}",
                type: "post",
                cache:false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    $('#add_page #loading').hide();
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
                        $('#add_page').modal('hide');
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