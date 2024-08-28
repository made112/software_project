<div class="table-responsive">
    <table class="table table-bordered mb-0 bg-white" id="html_table" width="100%">
                <thead class="m-datatable__head">
                    <tr>
                            <th class="text-center">{{trans('lang.license_code')}}</th>
                            <th class="text-center">{{trans('lang.product_name')}}</th>
                            <th class="text-center">{{trans('lang.company')}}</th>
                            <th class="text-center">{{trans('lang.date_modified')}}</th>
                            <th class="text-center">{{trans('lang.expiration')}} ({{trans('lang.day')}})</th>
                            {{-- <th class="text-center">{{trans('lang.uses_left')}}</th> --}}
                            <th class="text-center">{{trans('lang.status')}}</th>
                            <th class="text-center">{{trans('lang.block_status')}}</th>
                            <th class="text-center">{{trans('lang.ip_details')}}</th>
                            @can('block_licenses')
                            <th class="text-center">{{trans('lang.block')}}/{{trans('lang.unblock')}}</th>
                            @endcan
                            @can('download_licenses')
                            <th class="text-center">{{trans('lang.download')}}</th>
                            @endcan
                            @can('send_mail_licenses')
                            <th class="text-center">{{trans('lang.send_mail')}}</th>
                            @endcan
                            @can('update_licenses')
                            <th class="text-center">{{trans('lang.edit')}}</th>
                            @endcan
                            {{-- @can('delete_licenses') --}}
                            {{-- <th class="text-center">{{trans('lang.delete')}}</th> --}}
                            {{-- @endcan --}}
                    </tr>
                </thead>
                <tbody class="m-datatable__body load">
                    @php
                        $i =1;
                    @endphp
                    @if(count($data['licenses']) > 0)
                        @foreach($data['licenses'] as $p)
                        @php

                        if($p->block == 1){
                            $class2='btn btn-black m-btn text-white m-btn--icon m-btn--pill';
                            $color2='black';
                            $icon2='check';
                        }else if($p->block == 0){
                            $class2='btn btn-danger m-btn m-btn--icon m-btn--pill';
                            $color2='red';
                            $icon2='check';
                        }else{
                            $class2='btn btn-success m-btn m-btn--icon m-btn--pill';
                            $color2='green';
                            $icon2='check';
                        }
                        @endphp

                        <tr class="m-datatable__row">
                            <td class="text-center">
                                {{$p->license_code}}
                            </td>

                            <td class="text-center">
                                @if($p->product)
                                {{$p->product->name}}
                                @else
                                -
                                @endif
                            </td>
                            <td class="text-center">
                                @if($p->client)
                                {{$p->client->name}}
                                @else
                                -
                                @endif
                            </td>
                            <td class="text-center">
                                {{date('Y-m-d H:i',strtotime($p->updated_at))}}
                            </td>
                            <td class="text-center">
                                @if($p->date)
                                @php
                                $now = time();
                                $your_date = strtotime($p->date);
                                $datediff = $your_date - $now;
                                if($datediff<0){
                                    $datediff = 0;
                                }
                                @endphp
                                {{round($datediff / (60 * 60 * 24))}}
                                @else
                                    {{trans('lang.unlimited')}}
                                @endif
                            </td>
                            {{-- <td class="text-center">
                                {{$p->uses_left}} ({{$p->parallel_use_limit}}{{trans('lang.parallel')}})
                            </td> --}}
                            <td class="text-center">
                                <a  data-id="{{$p->id}}" class="btn {{$p->license_status['color']}} m-btn m-btn--icon m-btn--pill py-1"  href="javaScript:;">  <span>{{$p->license_status['status']}}</span> </a>
                            </td>
                            <td class="text-center">
                                <a  color="{{$color2}}" data-id="{{$p->id}}" class="{{$class2}} py-1"  href="javaScript:;">  <span>{{$p->status_name}}</span> </a>
                            </td>
                            <td class="text-center"><a href="#"  data-id="{{$p->id}}"  class="btn btn-info btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                                ip_details"> <i class="fa fa-clipboard-check"></i> </a>
                            </td>
                            @can('block_licenses')
                            <td class="text-center">

                                <a href="{{URL::to('/')}}/admin/licenses/edit/{{$p->id}}" data-id="{{$p->id}}" class="btn btn-warning btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air block_licenses">
                                    <i class="fa @if($p->block == 1)fa-lock @else fa-unlock @endif"></i>
                                </a>
                            </td>
                            @endcan
                            @can('download_licenses')
                            @if($p->type == 2)
                            <td class="text-center"><a href="{{URL::to('/')}}/admin/licenses/download/{{$p->id}}" target="_blank" data-id="{{$p->id}}" data-code="{{$p->license_code}}" data-date="{{$p->date}}" data-limit="{{$p->use_limit_lin}}" class="btn btn-primary btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                                "> <i class="fas fa-download"></i> </a>
                            </td>
                            @else
                           <td class="text-center">-</td>
                            @endif
                            @endcan
                            @can('send_mail_licenses')
                            <td class="text-center"><a href="#" data-email="@if($p->client){{$p->client->email}}@endif" data-id="{{$p->id}}" data-code="{{$p->license_code}}" data-date="{{$p->date}}" data-limit="{{$p->use_limit_lin}}" class="btn btn-warning btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                                send_mail"> <i class="fas fa-envelope"></i> </a>
                            </td>
                            @endcan
                            @can('update_licenses')
                            <td class="text-center">
                            <a href="{{URL::to('/')}}/admin/licenses/edit/{{$p->id}}" data-id="{{$p->id}}" class="btn btn-success btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                            "> <i class="flaticon-edit"></i> </a>
                            </td>
                            @endcan
                            {{-- @can('delete_licenses')
                            <td class="text-center"><a href="#" data-id="{{$p->id}}" class="btn btn-danger btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                                delete"> <i class="fa fa-trash"></i> </a>
                            </td>
                            @endcan --}}
                        </tr>
                        @endforeach
                    @else
                    <tr  class="m-datatable__row"><td colspan="10" class="text-center">{{trans('lang.no_data')}}</td></tr>
                    @endif
                </tbody>

        </table>
        <div class="mt-3" style="text-align: center;">
                {!! $data['licenses']->render() !!}
        </div>
    </div>
