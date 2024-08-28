<div class="m-portlet" style="box-shadow: none;"><div class="m-portlet__body" style="padding: 0;">
    @foreach($permissions as $permission)
       @php 
        $i = 0;
        $z = 0;
        $i++;
       @endphp
       <div class="panel panel-default">
        @foreach($permission as $per)
            @php
                $z++;
                $checked ='';
                $per_group='';
            @endphp
            @foreach($user_permissions as $user_permission)
                @php
                if($user_permission->id == $per->id){
                    $checked ='checked';
                }
                @endphp
            @endforeach
            
            @if($per->group == 1)
                   <div class="m-portlet__head" style="height: 2.7rem;">
                    <h3 class="m-portlet__head-title">
                            <div class="md-checkbox">
                            <label class="m-checkbox m-checkbox--solid m-checkbox--brand" for="p{{$per->name_en}}">
                                    <input id="p{{$per->name_en}}" {{$checked}} data-id="p{{$per->group_id}}" class="group_per p{{$per->group_id}}" type="checkbox">{{$per->name}}<span></span>
                            </label>
                            </div>
                        </h3>
                    </div>
                @php 
                    $per_group = $per->id;
                @endphp
           @endif

            @if($z == 1)
                <div class="m-portlet__body" id="mtab_storesm">
                <div class="md-checkbox-inline col-lg-12 col-xs-12 col-sm-12 row">
            @endif
            
                    <div class="row md-checkbox col-lg-3 col-xs-3 col-sm-3">
                            <label class="m-checkbox m-checkbox--solid m-checkbox--brand" for="{{$per->name_en}}">
                                <input type="checkbox" id="{{$per->name_en}}"  value="{{$per->id}}" {{$checked}}  name="permissions[]"  class="p{{$per->group_id}}">
                                {{$per->name}}
                                <span class="col_name1"></span>
                            </label>
                    </div>

            @if($z == count($permission))
                </div></div>
            @endif

        @endforeach


        </div>
    @endforeach
    </div></div>