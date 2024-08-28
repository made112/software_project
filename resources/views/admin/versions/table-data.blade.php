<div class="table-responsive">
    <table class="table table-bordered mb-0 bg-white" id="html_table" width="100%">
                <thead class="m-datatable__head">
                    <tr>
                            <th class="text-center">{{trans('lang.version')}}</th>
                            <th class="text-center">{{trans('lang.release_date')}}</th>
                            <th class="text-center">{{trans('lang.notification_summry')}}</th>
                            <th class="text-center">{{trans('lang.downloads')}}</th>
                            <th class="text-center">{{trans('lang.status')}}</th>
                            @can('status_version')
                            <th class="text-center">{{trans('lang.published')}}/{{trans('lang.unpublished')}}</th>
                            @endcan
                            @can('download_files')
                            <th class="text-center">{{trans('lang.download_files')}}</th>
                            @endcan
                            @can('update_versions')
                            <th class="text-center">{{trans('lang.edit')}}</th>
                            @endcan
                            @can('delete_versions')
                            <th class="text-center">{{trans('lang.delete')}}</th>
                            @endcan
                    </tr>
                </thead>
                <tbody class="m-datatable__body load">
                    @php
                        $i =1;
                    @endphp
                    @if(count($data['versions']) > 0)
                        @foreach($data['versions'] as $v)
                        @php
                        if($v->publish_version == 1)
                            {
                            $class='btn btn-success m-btn m-btn--icon m-btn--pill';
                            $color='green';
                            $icon='check';
                            $text = trans("lang.published");
                        }else{
                            $class='btn btn-danger m-btn m-btn--icon m-btn--pill';
                            $color='red';
                            $icon='check';
                            $text = trans("lang.unpublished");
                        }
                        @endphp

                        <tr class="m-datatable__row">
                            <td class="text-center">
                                {{$v->name ?? '-'}}
                            </td>
                            <td class="text-center">
                                {{$v->date ?? '-'}}
                            </td>
                            <td class="text-center">
                                {{$v->notification_summry ?? '-'}}
                            </td>
                            <td class="text-center">
                                <a  data-id="{{$v->id}}" class="btn btn-dark m-btn m-btn--icon m-btn--pill py-1"  href="javaScript:;">  <span>{{$v->downloads}} {{trans('lang.downloads')}}</span> </a>
                            </td>
                            <td class="text-center">
                                <a  color="{{$color}}" data-id="{{$v->id}}" class="{{$class}} py-1"  href="javaScript:;">  <span>{{$text}}</span> </a>
                            </td>
                            @can('status_version')
                            <td class="text-center">
                                <a href="#" data-id="{{$v->id}}" class="btn btn-info btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air status_version">
                                    <i class="fa @if($v->publish_version == 1) fa-eye @else  fa-eye-slash @endif"></i>
                                </a>
                            </td>
                            @endcan
                            @can('download_files')
                            <td class="text-center">
                                @if($v->sql_files or $v->main_files)
                                <a href="#" data-id="{{$v->id}}" data-main="{{$v->main_files}}" data-sql="{{$v->sql_files}}" class="btn btn-warning btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                                    download"><i class="fas fa-download"></i> </a>
                                @else
                                -
                                @endif
                            </td>
                            @endcan
                            @can('update_versions')
                            <td class="text-center">
                            <a href="{{route('admin.versions.edit',['product_id'=>$product_id,'id'=>$v->id])}}" data-id="{{$v->id}}" class="btn btn-success btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                            "> <i class="flaticon-edit"></i> </a>
                            </td>
                            @endcan
                            @can('delete_versions')
                            <td class="text-center"><a href="#" data-id="{{$v->id}}" class="btn btn-danger btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
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
                {!! $data['versions']->render() !!}
        </div>
    </div>
