<table class="table table-bordered mb-0 bg-white" id="html_table" width="100%">
    <tr class="m-datatable__row">
        <th class="text-center" style="font-weight: bold">{{trans('lang.function')}}</th>
        <td class="text-center">
            {{$obj->function_name}}
        </td>
    </tr>

    <tr class="m-datatable__row">
        <th class="text-center" style="font-weight: bold">{{trans('lang.product_name')}}</th>
        <td class="text-center">
            @if($obj->product)
                {{$obj->product->name}}
            @else 
            -
            @endif
        </td>
    </tr>

    @if($obj->version)
    <tr class="m-datatable__row">
        <th class="text-center" style="font-weight: bold">{{trans('lang.version')}}</th>
        <td class="text-center">
            {{$obj->version->name}}
        </td>
    </tr>
    @endif

    <tr class="m-datatable__row">
        <th class="text-center" style="font-weight: bold">{{trans('lang.client')}}</th>
        <td class="text-center">
            @if($obj->client)
                {{$obj->client->name}}
            @else 
            -
            @endif
        </td>
    </tr>

    @if($obj->function == 6)
    <tr class="m-datatable__row">
        <th class="text-center" style="font-weight: bold">{{trans('lang.download_from_url')}}</th>
        <td class="text-center">
            {{$obj->download_url}}
        </td>
    </tr>
    @endif

    <tr class="m-datatable__row">
        <th class="text-center" style="font-weight: bold">{{trans('lang.using_licenses')}}</th>
        <td class="text-center">
            {{$obj->license_code}}
        </td>
    </tr>

    <tr class="m-datatable__row"> 
        <th class="text-center" style="font-weight: bold">{{trans('lang.domain')}}</th>
        <td class="text-center">
            {{$obj->domain}}
        </td>
    </tr>

    
    <tr class="m-datatable__row"> 
        <th class="text-center" style="font-weight: bold">{{trans('lang.ip')}}</th>
        <td class="text-center">
            {{$obj->ip}}
        </td>
    </tr>

    <tr class="m-datatable__row"> 
        <th class="text-center" style="font-weight: bold">{{trans('lang.activations_date')}}</th>
        <td class="text-center">
            {{date('d/m/Y, h:i A',strtotime($obj->created_at))}}
        </td>
    </tr>

    <tr>
        <th class="text-center" style="font-weight: bold">{{trans('lang.validation_error')}}</th>
        <td class="text-center">
            {{$obj->validation_error}}
        </td>
    </tr>
    <tr>
        <th class="text-center" style="font-weight: bold">{{trans('lang.server_error')}}</th>
        <td class="text-center">
            {{$obj->errors}}
        </td>
    </tr>

</table>