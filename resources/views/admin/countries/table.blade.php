<div class="table-responsive">
    <table class="table table-bordered mb-0 bg-white" id="html_table" width="100%">
        <thead class="m-datatable__head">
            <tr>
                <th>#</th>
                <th class="text-center">{{ trans('lang.name_ar') }}</th>
                <th class="text-center">{{ trans('lang.name_en') }}</th>
                <th class="text-center">{{ trans('lang.country_code') }}</th>
                @can('update_status_countries')
                <th class="text-center">{{ trans('lang.status') }}</th>
                @endcan
                <th class="text-center">ISO2</th>
                <th class="text-center">ISO3</th>
                <th class="text-center">{{ trans('lang.time_zone') }}</th>
                <th class="text-center">{{ trans('lang.longitude') }}</th>
                <th class="text-center">{{ trans('lang.latitude') }}</th>

            </tr>
        </thead>
        <tbody class="m-datatable__body load">

            @if (count($countries) > 0)
                @foreach ($countries as $country)
                    @php
                        if ($country->status) {
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
                        <td>{{ $country->id }}</td>
                        <td class="text-center">{{ object_get($country, 'name_ar') }}</td>
                        <td class="text-center">{{ object_get($country, 'name_en') }}</td>
                        <td class="text-center">{{ object_get($country, 'country_code') }}</td>
                        @can('update_status_countries')
                        <td class="text-center">
                            <a color="{{ $color }}" data-id="{{ $country->id }}"
                                class="{{ $class }} py-1 country_status" href="javaScript:;">
                                <span>{{ $text }}</span>
                            </a>
                        </td>
                        @endcan
                        <td class="text-center">{{ object_get($country , 'iso2') }}</td>
                        <td class="text-center">{{ object_get($country , 'iso3') }}</td>
                        <td class="text-center">{{ object_get($country , 'timezone') }}</td>
                        <td class="text-center">{{ object_get($country , 'longitude') }}</td>
                        <td class="text-center">{{ object_get($country , 'latitude') }}</td>

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
        {{ $countries->links() }}
    </div>
</div>
