<div class="modal fade in" id="add_page" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="addNewpage" id="addNewpage" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('lang.edit_status') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group m-form__group row">

                        {{-- Start Arabic Name --}}
                        <div class="col-md-6 mb-4">
                            <label>{{trans('lang.name_ar')}} <span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="name_ar" class="form-control name_ar" placeholder="{{trans('lang.name_ar')}}">
                            </div>
                        </div>
                        {{-- End Arabic Name --}}

                        {{-- Start English Name --}}
                        <div class="col-md-6 mb-4">
                            <label>{{trans('lang.name_en')}} <span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="name" class="form-control name" placeholder="{{trans('lang.name_en')}}">
                            </div>
                        </div>


                        {{-- End English Name --}}
                        <div class="col-md-12 mb-4">
                            <label>{{trans('lang.color')}} <span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="color" name="color" class="form-control color" placeholder="{{trans('lang.name_en')}}">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn_save_page">{{trans('lang.save')}}</button>
                    <button type="button" class="btn btn-secondary  " data-dismiss="modal">{{trans('lang.hide')}}</button>
                </div>
                <div id="loading">
                    <img id="loading-image" src="/admin-assets/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
                <input type="hidden" name="hidden" class="rowIdUpdate" value="0">
            </form>
        </div>
    </div>
</div>


<div class="modal fade in" id="permission_users" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="permission_users_form" id="permission_users_form" action="" method="post">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel"> {{trans('lang.permission')}} </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group m-form__group row" id="permission-body">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn_save_password">{{trans('lang.save')}}</button>
                    <button type="button" class="btn btn-secondary  " data-dismiss="modal">{{trans('lang.hide')}}</button>
                </div>
                <div id="loading">
                    <img id="loading-image" src="/admin-assets/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
            </form>
        </div>
    </div>
</div>


