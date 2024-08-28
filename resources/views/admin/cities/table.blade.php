<div class="table-responsive">
    <table class="table table-bordered mb-0 bg-white" id="html_table" width="100%">
        <thead class="m-datatable__head">
            <tr>
                <th>#</th>
                <th class="text-center">{{ trans('lang.name_ar') }}</th>
                <th class="text-center">{{ trans('lang.name_en') }}</th>
                <th class="text-center">{{ trans('lang.country') }}</th>
                @can('update_status_cities')
                <th class="text-center">{{ trans('lang.status') }}</th>
                @endcan
                @can('update_cities')
                <th class="text-center">{{ trans('lang.edit') }}</th>
                @endcan
                @can('delete_cities')
                <th class="text-center">{{ trans('lang.delete') }}</th>
                @endcan
            </tr>
        </thead>
        <tbody class="m-datatable__body load">

            @if (count($cities) > 0)
                @foreach ($cities as $city)
                    @php
                        if ($city->status) {
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

                    <tr>
                        <td>{{ $city->id }}</td>
                        <td class="text-center">{{ object_get($city, 'name_ar') }}</td>
                        <td class="text-center">{{ object_get($city, 'name_en') }}</td>
                        <td class="text-center">{{ object_get($city, 'country.country_name') }}</td>
                        @can('update_status_cities')
                        <td class="text-center">
                            <a color="{{ $color }}" data-id="{{ $city->id }}"
                                class="{{ $class }} py-1 city_status" href="javaScript:;">
                                <span>{{ $text }}</span>
                            </a>
                        </td>
                        @endcan
                        @can('update_cities')
                        <td class="text-center">
                            <a href="{{ route('admin.cities.edit' , ['city' => $city->id]) }}" data-id="{{ $city->id }}" class="btn btn-success btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                            "> <i class="flaticon-edit"></i> </a>
                        </td>
                        @endcan
                        @can('delete_cities')
                        <td class="text-center">
                            <a href="#" data-id="{{$city->id}}"  class="btn btn-danger btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air delete"> <i class="fa fa-trash"></i> </a>
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
    <div style="text-align: center;">
        {{ $cities->links() }}
    </div>
</div>
