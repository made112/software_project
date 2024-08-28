<div class="table-responsive">
    <table class="table table-bordered mb-0 bg-white" id="html_table" width="100%">
                <thead class="m-datatable__head">
                    <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">{{trans('lang.logo')}}</th>
                            <th class="text-center">{{trans('lang.name')}}</th>
                            <th class="text-center">{{trans('lang.email')}}</th>
                            <th class="text-center">{{trans('lang.phone_number')}}</th>
                            <th class="text-center">{{trans('lang.status')}}</th>
                            @can('show_client_profile')
                            <th class="text-center">{{trans('lang.manage')}}</th>
                            @endcan
                            @can('update_clients')
                            <th class="text-center">{{trans('lang.edit')}}</th>
                            @endcan
                            @can('delete_clients')
                            <th class="text-center">{{trans('lang.delete')}}</th>
                            @endcan
                    </tr>
                </thead>
                <tbody class="m-datatable__body load">
                    @php
                        $i =1;
                    @endphp
                    @if(count($data['clients']) > 0)
                        @foreach($data['clients'] as $c)
                        @php
                        if($c->status == 1)
                            {
                            $class='btn btn-success m-btn m-btn--icon m-btn--pill';
                            $color='green';
                            $icon='check';
                            $text = trans("lang.active");
                            $data_status = trans("lang.deactivate");
                        }else{
                            $class='btn btn-danger m-btn m-btn--icon m-btn--pill';
                            $color='red';
                            $icon='check';
                            $text = trans("lang.inactive");
                            $data_status = trans("lang.activate");
                        }
                        @endphp

                        <tr class="m-datatable__row">
                            <td class="text-center">
                                {{$c->client_id}}
                            </td>
                            <td class="text-center">
                                <a href="{{ $c->logo }}" data-fancybox="gallary">
                                    <img src="{{ $c->logo }}" width="50px" height="50" style="border-radius:50%; height:50px; object-fit: cover;" alt="">
                                </a>
                            </td>
                            <td class="text-center">
                                {{$c->name ?? '-'}}
                            </td>
                            <td class="text-center">
                                {{$c->email ?? '-'}}
                            </td>
                            <td class="text-center">
                                {{$c->country_code ?? '-'}}{{$c->phone_number ?? '-'}}
                            </td>
                            <td class="text-center">
                                <a  color="{{$color}}" data-status="{{$data_status}}" data-name="{{$c->name}}" data-id="{{$c->id}}" class="{{$class}} py-1 update_status"  href="javaScript:;">  <span>{{$text}}</span> </a>
                            </td>
                            @can('show_client_profile')
                            <td class="text-center">
                            <a href="{{ route('admin.clients.show' , ['id' =>$c->id ]) }}" data-id="{{$c->id}}" class="btn btn-warning btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                            "> <i class="flaticon-settings-1"></i> </a>
                            </td>
                            @endcan
                            @can('update_clients')
                            <td class="text-center">
                            <a href="{{URL::to('/')}}/admin/clients/edit/{{$c->id}}" data-id="{{$c->id}}" class="btn btn-success btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                            "> <i class="flaticon-edit"></i> </a>
                            </td>
                            @endcan
                            @can('delete_clients')
                            <td class="text-center"><a href="#" data-id="{{$c->id}}" class="btn btn-danger btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                                delete"> <i class="fa fa-trash"></i> </a>
                            </td>
                            @endcan
                        </tr>
                        @endforeach
                    @else
                    <tr  class="m-datatable__row"><td colspan="10" class="text-center">{{trans('lang.no_data')}}</td></tr>
                    @endif
                </tbody>

        </table>
        <div class="mt-3" style="text-align: center;">
                {!! $data['clients']->render() !!}
        </div>
    </div>
