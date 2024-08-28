<div class="modal fade in" id="ip_details_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('lang.ip_details')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">{{trans('lang.ip')}}</th>
                                <th class="text-center">{{trans('lang.is_used')}}</th>
                                <th class="text-center">{{trans('lang.is_activate')}}</th>
                            </tr>
                        </thead>
                        <tbody id="ip-details"></tbody>
                    </table>
                    
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary px-5" data-dismiss="modal">{{trans('lang.hide')}}</button>
                </div>
                <input type="hidden" name="hidden" class="rowIdUpdate" value="0">
               
        </div>
    </div>
</div>