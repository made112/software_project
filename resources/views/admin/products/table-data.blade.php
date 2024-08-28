<div class="table-responsive">
    <table class="table table-bordered mb-0 bg-white" id="html_table" width="100%">
        <thead class="m-datatable__head">
            <tr>
                <th class="text-center">ID</th>
                {{-- <th class="text-center">{{trans('lang.name')}}</th> --}}
                <th class="text-center">{{ trans('lang.product_name') }}</th>
                <th class="text-center">{{ trans('lang.lastest_version') }}</th>
                <th class="text-center">{{ trans('lang.last_release_date') }}</th>
                <th class="text-center">{{trans('lang.created_at')}}</th>
                <th class="text-center">{{ trans('lang.status') }}</th>
                @can('versions')
                    <th class="text-center">{{ trans('lang.versions') }}</th>
                @endcan
                @can('packages')
                    <th class="text-center">{{ trans('lang.packages') }}</th>
                @endcan
                @can('update_products')
                    <th class="text-center">{{ trans('lang.edit') }}</th>
                @endcan
                @can('delete_products')
                    <th class="text-center">{{ trans('lang.delete') }}</th>
                @endcan
            </tr>
        </thead>
        <tbody class="m-datatable__body load">
            @php
                $i = 1;
            @endphp
            @if (count($data['products']) > 0)
                @foreach ($data['products'] as $p)
                    @php
                        if ($p->status == 1) {
                            $class = 'btn btn-success m-btn m-btn--icon m-btn--pill';
                            $color = 'green';
                            $icon = 'check';
                            $text = trans('lang.active');
                        } else {
                            $class = 'btn btn-danger m-btn m-btn--icon m-btn--pill';
                            $color = 'red';
                            $icon = 'check';
                            $text = trans('lang.inactive');
                        }
                    @endphp

                    <tr class="m-datatable__row">
                        <td class="text-center">
                            {{ $p->product_id }}
                        </td>

                        <td class="text-center">
                            {{ $p->name ?? '-' }}
                        </td>
                        <td class="text-center">
                            @if ($p->last_version)
                                {{ $p->last_version->name }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($p->last_version)
                                {{ $p->last_version->date }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-center">
                            {{date('Y-m-d',strtotime($p->created_at))}}
                        </td>
                        <td class="text-center">
                            <a color="{{ $color }}" data-id="{{ $p->id }}"
                                class="{{ $class }} py-1 update_status" href="javaScript:;"> <span>{{ $text }}</span>
                            </a>
                        </td>
                        @can('versions')
                            <td class="text-center"><a href="{{ URL::to('/') }}/admin/versions/{{ $p->id }}"
                                    data-id="{{ $p->id }}"
                                    class="btn btn-warning btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                                ">
                                    <i class="flaticon-settings"></i> </a>
                            </td>
                        @endcan
                        @can('packages')
                            <td class="text-center">
                                <a href="{{ route('admin.products.packages.index' , ['product' => $p->id]) }}"
                                    data-id="{{ $p->id }}"
                                    class="btn btn-success btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                            ">
                                    <i class="fa fa-boxes"></i> </a>
                            </td>
                        @endcan
                        @can('update_products')
                            <td class="text-center">
                                <a href="{{ URL::to('/') }}/admin/products/edit/{{ $p->id }}"
                                    data-id="{{ $p->id }}"
                                    class="btn btn-success btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                            ">
                                    <i class="flaticon-edit"></i> </a>
                            </td>
                        @endcan
                        @can('delete_products')
                            <td class="text-center"><a href="#" data-id="{{ $p->id }}"
                                    class="btn btn-danger btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                                delete">
                                    <i class="fa fa-trash"></i> </a>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            @else
                <tr class="m-datatable__row">
                    <td colspan="10" class="text-center">{{ trans('lang.no_data') }}</td>
                </tr>
            @endif
        </tbody>

    </table>
    <div class="mt-3" style="text-align: center;">
        {!! $data['products']->render() !!}
    </div>
</div>
