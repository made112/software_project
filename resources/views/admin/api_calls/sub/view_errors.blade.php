<div class="modal fade in" id="api_call_modal" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('lang.details')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary px-5" data-dismiss="modal">{{trans('lang.hide')}}</button>
                </div>
                <input type="hidden" name="hidden" class="rowIdUpdate" value="0">
                <div id="loading">
                    <img id="loading-image" src="/admin-assets/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
        </div>
    </div>
</div>

<script>
     $(document).on('click','.view_error',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('admin.api-calls.view-error')}}",
            type: "get",
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(data){
                if(data['status'] == true){
                    $('#api_call_modal .modal-body').html(data.data);
                    $('#api_call_modal').modal('show');
                }else{
                    swal({
                        title: "",
                        text: data["data"],
                        type: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "{{trans('lang.ok')}}",
                        cancelButtonText: "{{trans('lang.cancel')}}",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    });
                }
            },
        });
    });
</script>