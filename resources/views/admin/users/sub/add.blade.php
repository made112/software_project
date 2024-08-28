<div class="modal fade in" id="add_page"  role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="addNewpageForm" id="addNewpageForm" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة مستخدم جديد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group m-form__group row">
                        <div class="col-md-6 mb-4">
                            <label>{{trans('lang.user_name')}} <span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="user_name" class="form-control user_name" placeholder="{{trans('lang.user_name')}}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="recipient-name" class="form-control-label">{{trans('lang.password')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="password" name="password" class="form-control password" placeholder="{{trans('lang.password')}}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label>{{trans('lang.name')}} <span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="name_profile" class="form-control name_profile" placeholder="{{trans('lang.name')}}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label>{{trans('lang.email')}} <span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="email" class="form-control email" placeholder="{{trans('lang.email')}}">
                            </div>
                        </div>


                        <div class="col-md-6 mb-4">
                            <label>{{trans('lang.role')}} <span class="required">*</span></label>
                            <div class="form-valid">
                                <select name="type" id="type" class="form-control type" >
                                    @if($data['roles'])
                                        @foreach($data['roles'] as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                    </div>


                    <div class="form-group m-form__group row">
                        <div class="col-md-6">
                            <label> {{trans('lang.status')}} <span class="required"></span></label>
                            <div class="form-valid">
                                <input type="checkbox" value="on" name="activeValue" id="activeValue"
                                 data-on-color="success" class="make-switch status activeValue"
                                 data-size="normal" data-on-text="{{trans('lang.on')}}"
                                 data-off-text="{{trans('lang.off')}}">
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

<div class="modal fade in" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="changepasswordform" id="changepasswordform" action="" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> {{trans('lang.change_password')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group m-form__group row">
                        <div class="col-md-12">
                            <label>{{trans('lang.user_name')}}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="text" disabled class="form-control name" placeholder="{{trans('lang.user_name')}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>{{trans('lang.password')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="password" required name="password" class="form-control password" placeholder="{{trans('lang.password')}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>{{trans('lang.confirm_password')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="password" required name="confirmation_password" class="form-control confirm_password" placeholder="{{trans('lang.confirm_password')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn_save_password">{{trans('lang.save')}}</button>
                    <button type="button" class="btn btn-secondary  " data-dismiss="modal">{{trans('lang.hide')}}</button>
                </div>
                <div id="loading">
                    <img id="loading-image" src="/admin-assets/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
                <input type="hidden" name="hidden" class="userIdUpdate" value="0">
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
                <input type="hidden" name="hidden" class="user_id" value="0">
            </form>
        </div>
    </div>
</div>


