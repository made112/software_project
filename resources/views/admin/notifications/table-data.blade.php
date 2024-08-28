<div class="table-responsive">
    <table class="table table-bordered mb-0 bg-white" id="html_table" width="100%">
                <thead class="m-datatable__head">
                    <tr>
                        <th class="text-center">{{trans('lang.created_date')}}</th>
                        <th class="text-center">{{trans('lang.notification_title')}}</th>
                        <th class="text-center">{{trans('lang.channel_id')}}</th>
                        <th class="text-center">{{trans('lang.status')}}</th>
                        <th class="text-center">{{trans('lang.publish_date')}}</th>
                        @can('view_notifications')
                        <th class="text-center">{{trans('lang.view')}}</th>
                        @endcan
                        @can('update_notifications')
                        <th class="text-center">{{trans('lang.edit')}}</th>
                        @endcan
                        @can('delete_notifications')
                        <th class="text-center">{{trans('lang.delete')}}</th>
                        @endcan

                    </tr>
                </thead>
                <tbody class="m-datatable__body load">
                    @php
                        $i =1;
                    @endphp
                    @if(count($data['notifications']) > 0)
                        @foreach($data['notifications'] as $n)
                        @php
                        if($n->status == 1)
                            {
                            $class='btn btn-success m-btn m-btn--icon m-btn--pill';
                            $color='green';
                            $icon='check';
                        }else{
                            $class='btn btn-danger m-btn m-btn--icon m-btn--pill';
                            $color='red';
                            $icon='check';
                        }
                        @endphp

                        <tr class="m-datatable__row">

                            <td class="text-center">
                                {{$n->created_at ?? '-'}}
                            </td>
                            <td class="text-center">
                                {{$n->notification_title ?? '-'}}
                            </td>
                            <td class="text-center">
                                {{$n->channel ?? '-'}}
                            </td>
                            <td class="text-center">
                                <a  color="{{$color}}" data-id="{{$n->id}}" class="{{$class}} py-1"  href="javaScript:;">  <span>{{$n->status_name ?? '-'}}</span> </a>
                            </td>
                            <td class="text-center">
                                {{$n->date ?? '-'}}
                            </td>
                            @can('view_notifications')
                            <td class="text-center">
                            <a href="{{route('admin.notifications.view',['id'=>$n->id])}}" data-id="{{$n->id}}" class="btn btn-success btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                            "> <i class="flaticon-eye"></i> </a>
                            </td>
                            @endcan
                            @can('update_notifications')
                            <td class="text-center">
                                @if($n->is_send == 0)
                            <a href="{{route('admin.notifications.edit',['id'=>$n->id])}}" data-id="{{$n->id}}" class="btn btn-success btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                            "> <i class="flaticon-edit"></i> </a>
                            @else
                                -
                            @endif
                            </td>
                            @endcan
                            @can('delete_notifications')
                            <td class="text-center"><a href="#" data-id="{{$n->id}}" class="btn btn-danger btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
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
        <div style="text-align: center;">
                {!! $data['notifications']->render() !!}
        </div>
    </div>
