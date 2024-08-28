
<div class="table-responsive" style="padding: 12px;background:#fff">

<table class="table table-bordered" id="html_table" width="100%">

			<thead class="m-datatable__head">

				<tr>

						<th class="text-center">#</th>


						<th class="text-center">{{trans('lang.name')}}</th>


						@can('permission_roles')

						<th class="text-center">{{trans('lang.permission')}}</th>

						@endcan

						@can('update_roles')

						<th class="text-center">{{trans('lang.edit')}}</th>

						@endcan


						

						@can('delete_roles')

						<th class="text-center">{{trans('lang.delete')}}</th>

						@endcan

				</tr>

			</thead>

			<tbody class="m-datatable__body load">

				@php 

					$i =1;

				@endphp

				@if(count($data['roles']) > 0)

					@foreach($data['roles'] as $roles)


					<tr class="m-datatable__row">

						<td  class="text-center">

							{{$i++}}

						</td>

						<td class="text-center">
							{{$roles->name}}
						</td>

						

						@can('permission_users')

						<td class="text-center">

							<a href="#" data-id="{{$roles->id}}" class="btn btn-dark btn-sm  m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air

							permission"> <i class="fas fa-user"></i></a>

						</td>

						@endcan
						
						@can('update_roles')

						<td class="text-center">

							<a href="#" data-id="{{$roles->id}}" class="btn btn-info btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air 

							updateDetails"> <i class="flaticon-edit"></i> </a>

						</td>

						@endcan

						@can('delete_roles')

						<td class="text-center"><a href="#" data-id="{{$roles->id}}" class="btn btn-danger btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							delete"> <i class="fa fa-trash"></i> </a>
						</td>

						@endcan

					</tr>

					@endforeach

				@else

				<tr class="m-datatable__row text-center"><td colspan="9">{{trans('lang.no_data')}}</td></tr>

				@endif

			</tbody>

	</table>
</div>
<div   style="text-align: center;">


</div>