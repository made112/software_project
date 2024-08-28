<div class="table-responsive">
    <table class="table table-bordered mb-0 bg-white" id="html_table" width="100%">
        <thead class="m-datatable__head">
            <tr>
                <th class="text-center">{{ trans('lang.package_name') }}</th>
                <th class="text-center">{{ trans('lang.type') }}</th>
                <th class="text-center">{{ trans('lang.duration') }}</th>
                <th class="text-center">{{ trans('lang.support_type') }}</th>
                @can('update_status_packages')
                    <th class="text-center">{{ trans('lang.status') }}</th>
                @endcan
                @can('edit_packages')
                    <th class="text-center">{{ trans('lang.edit') }}</th>
                @endcan
                @can('delete_packages')
                    <th class="text-center">{{ trans('lang.delete') }}</th>
                @endcan
            </tr>
        </thead>
        <tbody class="m-datatable__body load">

            @if (count($packages) > 0)
                @foreach ($packages as $package)
                    @php
                        if ($package->status) {
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

                    <tr class="package-{{ $package->id }}">

                        <td class="text-center">
                            {{ $package->name }}
                        </td>
                        <td class="text-center">
                            @if ($package->type == 1)
                                {{ 'Free' }}
                            @elseif($package->type == 2)
                                {{ 'Paid' }}
                            @endif

                        </td>
                        <td class="text-center">
                            @if ($package->duration == 1)
                                {{ $package->duration_days . ' Days' }}
                            @elseif($package->duration == 2)
                                {{ $package->time . ' Month' }}
                            @elseif($package->duration == 3)
                                {{ 'One Year' }}
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($package->support_type == 2 && $package->prime_type == 2)
                                {{ 'Remotely : paid' }} <br> {{ 'Prime : Paid' }}
                            @elseif($package->support_type == 2 && !$package->prime_type)
                                {{ 'Remotely : Paid' }}
                            @elseif( $package->prime_type == 2 && !$package->support_type )
                                {{ 'Prime : Paid' }}
                            @elseif( $package->support_type == 1 &&  $package->prime_type == 2)

                                    {{ 'Remotely : Free' }} <br> {{ 'Prime : Paid' }}

                            @elseif( $package->support_type == 2 &&  $package->prime_type == 1)

                                    {{ 'Remotely : Paid' }} <br> {{ 'Prime : Free' }}

                            @elseif($package->support_type == 1 && $package->prime_type == 1)

                                    {{ 'Remotely : Free' }} <br> {{ 'Prime : Free' }}

                            @elseif($package->support_type == 1 && !$package->prime_type)

                                    {{ 'Remotely : Free' }}

                            @elseif ($package->prime_type == 1)
                                {{ 'Prime : Free' }}
                            @elseif(!$package->support_type && !$package->prime_type)
                                <p class="text-danger">
                                    {{ 'There Is No Support Type' }}
                                </p>
                            @endif
                        </td>
                        @can('update_status_packages')
                            <td class="text-center">
                                <a color="{{ $color }}" data-id="{{ $package->id }}"
                                    class="{{ $class }} py-1 package_status" href="javaScript:;">
                                    <span>{{ $text }}</span>
                                </a>
                            </td>
                        @endcan
                        @can('edit_packages')
                            <td class="text-center">
                                <a href="{{ route('admin.products.packages.edit', ['product' => $product->id, 'package' => $package->id]) }}"
                                    class="btn btn-success btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
                                    <i class="flaticon-edit"></i>
                                </a>
                            </td>
                        @endcan
                        @can('delete_packages')
                            <td class="text-center">
                                <button type="button" data-id="{{ $package->id }}"
                                    data-url="{{ route('admin.products.packages.destroy', ['product' => $product->id, 'package' => $package->id]) }}"
                                    class="btn btn-danger btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air delete-package">
                                    <i class="fa fa-trash"></i>
                                </button>
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
    <div class="mt-4" style="text-align: center;">
        {{ $packages->links() }}
    </div>
</div>
