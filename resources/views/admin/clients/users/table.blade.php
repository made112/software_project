<style>
    .table td {
        vertical-align: middle;
    }

</style>
<div class="table-responsive">
    <table class="table table-bordered mb-0 bg-white" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>{{ __('lang.employee_name') }}</th>
                <th>{{ __('lang.product_name') }}</th>
                <th>{{ __('lang.email') }}</th>
                <th>{{ __('lang.phone_number') }}</th>
                <th>{{ __('lang.job_title') }}</th>
                @can('change_status_client_user')
                <th>{{ __('lang.status') }}</th>
                @endcan
                @can('edit_client_user')
                <th>{{ __('lang.edit') }}</th>
                @endcan
                @can('delete_client_user')
                    <th>{{ __('lang.actions') }}</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="align-middle">
                    <td style="width: 75px">
                        <img src="{{ object_get($user, 'photo') }}" style="width: 100%;max-height: 75px">
                    </td>
                    <td>{{ object_get($user, 'first_name', '-') }} {{ object_get($user, 'last_name', '-') }}</td>
                    <td>
                        @if (count($user->products))
                            @foreach ($user->products as $product)
                                {{ $product->name }},
                            @endforeach
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ object_get($user, 'email', '-') }}</td>
                    <td>+ {{ object_get($user, 'mobile_country') . object_get($user, 'phone_number') }}</td>
                    <td>{{ object_get($user, 'job_title', '-') }}</td>
                    @can('change_status_client_user')
                    <td>
                        <span class="btn btn-{{ object_get($user, 'status_color') }} btn-sm update_status" data-id="{{$user->id}}" data-status="@if($user->status == 1){{trans('lang.deactivate')}}@else{{trans('lang.activate')}}@endif" data-name="{{$user->name}}">
                            {{ object_get($user, 'status_name') }}
                        </span>
                    </td>
                    @endcan
                    @can('edit_client_user')
                    <td>
                        <a href="{{ route('admin.clients.users.edit', ['clientId' => $client->id, 'userId' => $user->id]) }}"
                            class="btn btn-success btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
                            <i class="flaticon-edit" aria-hidden="true"></i>
                            </button>
                    </td>
                    @endcan
                    @can('delete_client_user')
                        <td>
                            <button class="btn btn-danger btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air" data-id="{{ $user->id }}"
                                onclick="deleteUser({{ $user->id }} , '{{ route('admin.clients.users.delete', ['clientId' => $client->id, 'userId' => $user->id]) }}')">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
