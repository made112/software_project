<div class="table-responsive">
    <table class="table table-bordered mb-0 bg-white" id="html_table" width="100%">
                <thead class="m-datatable__head">
                    <tr>    
                        <th class="text-center">
                            <input type="checkbox" class="all_under_collection" width="3%" value="all">
                        </th>
                        <th class="text-center">{{trans('lang.function')}}</th>
                        <th class="text-center">{{trans('lang.product_name')}}</th>
                        <th class="text-center">{{trans('lang.company')}}</th>
                        <th class="text-center">{{trans('lang.using_licenses')}}</th>
                        <th class="text-center">{{trans('lang.domain')}}</th>
                        <th class="text-center">{{trans('lang.ip')}}</th>
                        <th class="text-center">{{trans('lang.activations_date')}}</th>
                        <th class="text-center">{{trans('lang.status')}}</th>
                        <th class="text-center">{{trans('lang.errors')}}</th>
                        @can('delete_activations')
                            <th class="text-center">{{ trans('lang.delete') }}</th>
                        @endcan
                    </tr>
                </thead>
                <tbody class="m-datatable__body load">
                    @php
                        $i =1;
                    @endphp
                    @if(count($data['activation']) > 0)
                        @foreach($data['activation'] as $a)
                        @php
                        if($a->status == 1)
                            {
                            $class='btn btn-success m-btn m-btn--icon m-btn--pill';
                            $color='green';
                            $icon='check';
                            $text = trans("lang.success");
                        }else{
                            $class='btn btn-danger m-btn m-btn--icon m-btn--pill';
                            $color='red';
                            $icon='check';
                            $text = trans("lang.faild");
                        }
                        @endphp 


                        <tr class="m-datatable__row">
                            <td class="text-center" width="3%">
                                <input type="checkbox" class="under_collection" name="check[]" value="{{$a->id}}">
                            </td>
                            <td class="text-center">
                                {{$a->function_name}}
                            </td>
                            <td class="text-center">
                                @if($a->product)
                                    {{$a->product->name}}
                                @else 
                                -
                                @endif
                            </td>
                          
                            <td class="text-center">
                                @if($a->client)
                                    {{$a->client->name}}
                                @else 
                                -
                                @endif
                            </td>
                            <td class="text-center">
                                {{$a->license_code}}
                            </td>
                            <td class="text-center">
                                {{$a->domain}}
                            </td>
                            <td class="text-center">
                                {{$a->ip}}
                            </td>
                            <td class="text-center">
                                {{date('d/m/Y, h:i A',strtotime($a->created_at))}}
                            </td>
                           
                            <td class="text-center">
                                <a  color="{{$color}}" data-id="{{$a->id}}" class="{{$class}} py-1"  href="javaScript:;">  <span>{{$text}}</span> </a>
                            </td>
                            <td class="text-center">
                                @if($a->status == 0)
                                <a href="#" data-id="{{ $a->id }}"
                                class="btn btn-warning btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air view_error"> <i class="fas fa-bug"></i> </a>
                                @else 
                                    -
                                @endif
                            </td>
                            @can('delete_activations')
                                <td class="text-center">
                                    <a href="#" data-id="{{ $a->id }}"  class="btn btn-danger btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air delete"> <i class="fa fa-trash"></i> </a>
                                </td>
                            @endcan
                        </tr>
                        @endforeach
                    @else
                    <tr  class="m-datatable__row"><td colspan="10" class="text-center">{{trans('lang.no_data')}}</td></tr>
                    @endif
                </tbody>
                
        </table>
        <div style="text-align: center;">
                {!! $data['activation']->render() !!}
        </div>
    </div>
    