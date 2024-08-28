<div class="table-responsive">
    <table class="table table-bordered mb-0 bg-white" id="html_table" width="100%">
        <thead class="m-datatable__head">
            <tr>
                <th class="text-center">{{ trans('lang.company') }}</th>
                <th class="text-center">{{ trans('lang.license_code') }}</th>
                <th class="text-center">{{ trans('lang.product_name') }}</th>
                <th class="text-center">{{ trans('lang.expiration') }} {{ trans('lang.date') }}</th>
                <th class="text-center">{{ trans('lang.project_manager_name') }}</th>
                <th class="text-center">{{ trans('lang.status') }}</th>
                <th class="text-center">{{ trans('lang.manage_company') }}</th>
            </tr>
        </thead>
        <tbody class="m-datatable__body load">
            @php
                $i = 1;
            @endphp
            @if (count($data['licenses']) > 0)
                @foreach ($data['licenses'] as $p)
                    @php
                        $start_date = $p->created_at;
                        $end_date = Carbon\Carbon::parse($p->date);

                        $current_time = \Carbon\Carbon::now(); // Return Object

                        $diffDays = $start_date->diffInDays($end_date);
                        $now = Carbon\Carbon::now()->diffInDays($end_date); // Return INT
                        $expired = $end_date->diffInDays(Carbon\Carbon::now());

                        $three_quarters = $diffDays / 3;

                        $second_time = $diffDays - $three_quarters * 2;
                    @endphp
                    @if ($diffDays >= $second_time && $expired <= 7 && $p->date)
                        @php

                            if ($p->block == 1) {
                                $class2 = 'btn btn-black m-btn text-white m-btn--icon m-btn--pill';
                                $color2 = 'black';
                                $icon2 = 'check';
                            } elseif ($p->block == 0) {
                                $class2 = 'btn btn-danger m-btn m-btn--icon m-btn--pill';
                                $color2 = 'red';
                                $icon2 = 'check';
                            } else {
                                $class2 = 'btn btn-success m-btn m-btn--icon m-btn--pill';
                                $color2 = 'green';
                                $icon2 = 'check';
                            }
                        @endphp

                        <tr class="m-datatable__row">
                            <td class="text-center">
                                @if ($p->client)
                                    {{ $p->client->name }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">
                                {{ $p->license_code }}
                            </td>
                            <td class="text-center">
                                @if ($p->product)
                                    {{ $p->product->name }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($end_date >= $current_time && $p->usage == 1)
                                    <span class="text-success">
                                        $now
                                    </span>
                                @elseif($p->usage == 0)
                                    <span class="text-info">
                                        {{ $now }}
                                    </span>
                                @elseif($p->usage == 2)
                                    <span class="text-danger">
                                        - {{ $expired }}
                                    </span>
                                @endif
                            </td>

                            <td class="text-center">
                                @if ($p->client)
                                    @if ($p->client->projects_manager)
                                        @foreach ($p->client->projects_manager as $key => $managers)
                                            @if ($managers->manager)
                                                @if ($key != 0)
                                                    ,
                                                @endif {{ $managers->manager->name }}
                                            @endif
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($end_date >= $current_time && $p->usage == 1)
                                    <span class="text-success">
                                        Active
                                    </span>
                                @elseif($p->usage == 0)
                                    <span class="text-info">
                                        Inactive
                                    </span>
                                @elseif($p->usage == 2)
                                    <span class="text-danger">
                                        Expired - {{ 'From ' . $expired . ' Days' }}
                                    </span>
                                @endif
                            </td>


                            <td class="text-center">
                                @if ($p->client)
                                    <a href="{{ URL::to('/') }}/admin/clients/{{ $p->client->id }}" target="_blank"
                                        data-id="{{ $p->id }}"
                                        class="btn btn-primary btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
                                        <i class="la la-users"></i>
                                    </a>
                                @else
                                    -
                                @endif

                            </td>

                        </tr>
                    @endif
                @endforeach
            @else
                <tr class="m-datatable__row">
                    <td colspan="10" class="text-center">{{ trans('lang.no_data') }}</td>
                </tr>
            @endif
        </tbody>

    </table>
    <div style="text-align: center;">
        {!! $data['licenses']->render() !!}
    </div>
</div>
