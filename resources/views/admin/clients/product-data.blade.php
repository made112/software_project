<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered mb-0 bg-white" id="html_table" width="100%">
                <tr>
                    <th class="text-center font-weight-bold">#</th>
                    <th class="text-center font-weight-bold">{{trans('lang.product_name')}}</th>
                    <th class="text-center font-weight-bold">{{trans('lang.contacts')}}</th>
                    <th class="text-center font-weight-bold">Licenses</th>
                    {{-- <th class="text-center font-weight-bold">{{trans('lang.licenses_status')}}</th> --}}
                    <th class="text-center font-weight-bold">{{trans('lang.product_status')}}</th>
                    <th class="text-center font-weight-bold">{{trans('lang.gitlab')}}</th>
                    <th class="text-center font-weight-bold">{{trans('lang.manage')}}</th>
                </tr>

                @if($client->products)
                    @php $i=0; @endphp
                    @foreach($client->products as $prod)
                        @php
                            if ($prod->status == 1) {
                                $text = trans('lang.active');
                            } else {
                                $text = trans('lang.inactive');
                            }
                        @endphp
                        <tr>
                            <td class="text-center">{{++$i}}</td>
                            <td class="text-center" >
                                {{ $prod->name }}
                            </td>
                            <td class="text-center" id="">
                                @if( $prod->supportUsers )
                                    @foreach( $prod->supportUsers as $key=>$users )
                                        {{ $users->first_name }} {{ $users->last_name }} <br>
                                    @endforeach
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">
                                @php
                                    $active_licenses = 0;
                                    $inactive_licenses = 0;
                                    $expired_licenses = 0;
                                    $blocked_licenses = 0;
                                @endphp

                                @if($prod->licenses)
                                    @php
                                        $active_licenses = $prod->licenses->where('usage',1)->where('date','>=',date('Y-m-d'))->count();
                                        $inactive_licenses = $prod->licenses->where('usage',0)->where('date','>=',date('Y-m-d'))->count();
                                        $expired_licenses = $prod->licenses->where('date','<',date('Y-m-d'))->count();
                                        $blocked_licenses = $prod->licenses->where('block',1)->count();
                                    @endphp

                                @endif

                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-outline-success btn-show-details btn-sm ml-2" style="border-style: dashed;" data-product="{{$prod->id}}" data-id="1">{{$active_licenses}} Active</button>
                                    <button class="btn btn-outline-danger btn-show-details btn-sm ml-2" style="border-style: dashed;" data-product="{{$prod->id}}" data-id="2">{{$inactive_licenses}} Inactive</button>
                                    <button class="btn btn-outline-warning btn-show-details btn-sm ml-2" style="border-style: dashed;" data-product="{{$prod->id}}" data-id="3">{{$expired_licenses}} Expired</button>
                                    <button class="btn btn-outline-dark btn-show-details btn-sm ml-2" style="border-style: dashed;" data-product="{{$prod->id}}" data-id="4">{{$blocked_licenses}} Blocked</button>
                                </div>
                            </td>
                            {{-- <td class="text-center">

                                @if($prod->licenses)
                                    @foreach($prod->licenses->sortByDesc('id')->take(1) as $key=>$licenses)
                                        {{$licenses->status_name}}
                                    @endforeach
                                @else
                                    -
                                @endif
                            </td> --}}
                            <td class="text-center">
                                {{$text}}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('gitlab', ['client_id' => $client->id, 'product_id' => $prod->id]) }}"  class="btn btn-info btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
                                    <i class="fa fa-cog"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{URL::to('/')}}/admin/clients/product-mange/{{$client->id}}/{{$prod->id}}"  class="btn btn-primary btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
                                    <i class="fa fa-cog"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
</div>
