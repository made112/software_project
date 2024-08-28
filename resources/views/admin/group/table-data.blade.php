
<div class="table-responsive" style="padding: 12px;background:#fff">

    <table class="table table-bordered" id="html_table" width="100%">

        <thead class="m-datatable__head">

        <tr>
            <th class="text-center">{{trans('lang.name')}}</th>
            <th class="text-center">{{trans('lang.name_ar')}}</th>
            <th class="text-center">{{ __('lang.role') }}</th>
            <th class="text-center">{{trans('lang.edit')}}</th>
            <th class="text-center">{{trans('lang.delete')}}</th>
        </tr>

        </thead>

        <tbody class="m-datatable__body load">

        @if( count($groups) > 0 )

            @foreach($groups as $group)

                @php
                   $roles = \Illuminate\Support\Facades\DB::table('group_roles')->where('group_id', $group->id)->get();
                @endphp

                <tr class="m-datatable__row">



                    <td class="text-center">

                        {{ $group->name }}

                    </td>

                    <td class="text-center">

                        {{ $group->name_ar }}

                    </td>

                    {{-- Type --}}
                    <td class="text-center">
                        @foreach( $roles as $role )
                            @php
                                $name = \Spatie\Permission\Models\Role::where('id', $role->role_id)->get();
                                foreach ($name as $na) {
                                  echo $na->name . ', ';
                                }
                            @endphp
                        @endforeach
                    </td>


                    <td class="text-center">
                        <a href="#" data-id="{{ $group->id }}" class="btn btn-info btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air

                        updateDetails">
                            <i class="flaticon-edit"></i>
                        </a>
                    </td>


                    <td class="text-center"><a href="#" data-id="{{ $group->id }}" class="btn btn-danger btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                        delete"> <i class="fa fa-trash"></i> </a>
                    </td>



                </tr>



            @endforeach
        @else

            <tr class="m-datatable__row text-center">
                <td colspan="9">
                    No Data
                </td>
            </tr>

        @endif

        </tbody>

    </table>
</div>
<div class="mt-3" style="text-align: center;">

    {!! $groups->links() !!}

</div>
