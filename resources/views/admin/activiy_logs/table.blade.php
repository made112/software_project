<div class="table-responsive">
    <table class="table table-bordered mb-0 bg-white" id="html_table" width="100%">
        <thead class="m-datatable__head">
            <tr>
                <th>
                    <input type="checkbox" id="select-all" class="checkbox">
                </th>
                @can('delete_activity_log')
                @endcan
                <th>{{ __('lang.log') }}</th>
                <th>{{ __('lang.date') }}</th>
                <th>{{ __('lang.ip') }}</th>
                @can('delete_activity_log')
                    <th class="text-center">{{ trans('lang.delete') }}</th>
                @endcan
            </tr>
        </thead>
        <tbody class="m-datatable__body load">
            @foreach ($activities as $activity)
                <tr>
                    @can('delete_activity_log')
                        <th>
                            <input type="checkbox" name="activities" value="{{ $activity->id }}" class="checkbox">
                        </th>
                    @endcan
                    <td> <b>{{ object_get($activity, 'causer.username') }}</b>
                        {{ $activity->description }}</td>
                    <td>{{ object_get($activity, 'created_at') }}</td>
                    <td>{{ $activity->ip_address  }}</td>
                    @can('delete_activity_log')
                        <td class="text-center">
                            <a href="#" data-id="{{ $activity->id }}" onclick="deleteActivity({{ $activity->id }})"
                                class="btn btn-danger btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                                delete">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
<div class="text-center mt-4 text-weight-bolder">

    {!! $activities->render() !!}

</div>

<script>
    $('.checkbox').on('click', function() {
        activities = []
        if ($('input[name="activities"]:checked').length) {
            $('.delete-activities').removeClass('d-none')
            $('input[name="activities"]:checked').each((index, element) => {
                activities.push(element.value)
            });
        } else {
            $('.delete-activities').addClass('d-none')
        }

    })


    function deleteActivity(id) {
        activities = [id]
        deleteActivities()
    }
</script>

{{-- Start Delete All From Js --}}
<script>
    $('#select-all').click(function(event) {
        if (this.checked) {
            $(':checkbox').each(function() {
                this.checked = true;

                $('.delete-activities').removeClass('d-none')
                activities = []
                if ($('input[name="activities"]:checked').length) {
                    $('input[name="activities"]:checked').each((index, element) => {
                        activities.push(element.value)
                    });
                }
            });
        } else {
            $(':checkbox').each(function() {
                this.checked = false;
                $('.delete-activities').addClass('d-none')
            });
        }
    });
</script>
{{-- End Delete All From Js --}}
