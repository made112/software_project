<div class="freshdesk-fillter active">
    <div class="head">
        <div class="title"> FILTERS </div>
        <div class="btn-search" data-toggle="collapse" data-target="#search-fields">
            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.99961 0.5C9.39758 0.499944 10.7678 0.890614 11.9555 1.62792C13.1432 2.36523 14.1012 3.41983 14.7214 4.6727C15.3416 5.92558 15.5993 7.32686 15.4654 8.71841C15.3315 10.11 14.8113 11.4364 13.9636 12.548L18.7066 17.293C18.886 17.473 18.9901 17.7144 18.9978 17.9684C19.0056 18.2223 18.9164 18.4697 18.7484 18.6603C18.5803 18.8508 18.3461 18.9703 18.0931 18.9944C17.8402 19.0185 17.5876 18.9454 17.3866 18.79L17.2926 18.707L12.5476 13.964C11.6006 14.6861 10.4953 15.1723 9.32305 15.3824C8.15083 15.5925 6.94543 15.5204 5.80661 15.1721C4.66778 14.8238 3.62826 14.2094 2.77406 13.3795C1.91986 12.5497 1.27555 11.5285 0.894433 10.4002C0.513317 9.27192 0.406356 8.06912 0.5824 6.89131C0.758444 5.7135 1.21243 4.59454 1.9068 3.62703C2.60117 2.65951 3.51595 1.87126 4.57545 1.32749C5.63495 0.783715 6.80871 0.500063 7.99961 0.5ZM7.99961 2.5C6.54091 2.5 5.14197 3.07946 4.11052 4.11091C3.07907 5.14236 2.49961 6.54131 2.49961 8C2.49961 9.45869 3.07907 10.8576 4.11052 11.8891C5.14197 12.9205 6.54091 13.5 7.99961 13.5C9.4583 13.5 10.8572 12.9205 11.8887 11.8891C12.9201 10.8576 13.4996 9.45869 13.4996 8C13.4996 6.54131 12.9201 5.14236 11.8887 4.11091C10.8572 3.07946 9.4583 2.5 7.99961 2.5Z" fill="#707070"/>
            </svg>
        </div>
    </div>
    <div class="collapse" id="search-fields">
        <div class="search-box">
            <div class="icon">
                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.99961 0.5C9.39758 0.499944 10.7678 0.890614 11.9555 1.62792C13.1432 2.36523 14.1012 3.41983 14.7214 4.6727C15.3416 5.92558 15.5993 7.32686 15.4654 8.71841C15.3315 10.11 14.8113 11.4364 13.9636 12.548L18.7066 17.293C18.886 17.473 18.9901 17.7144 18.9978 17.9684C19.0056 18.2223 18.9164 18.4697 18.7484 18.6603C18.5803 18.8508 18.3461 18.9703 18.0931 18.9944C17.8402 19.0185 17.5876 18.9454 17.3866 18.79L17.2926 18.707L12.5476 13.964C11.6006 14.6861 10.4953 15.1723 9.32305 15.3824C8.15083 15.5925 6.94543 15.5204 5.80661 15.1721C4.66778 14.8238 3.62826 14.2094 2.77406 13.3795C1.91986 12.5497 1.27555 11.5285 0.894433 10.4002C0.513317 9.27192 0.406356 8.06912 0.5824 6.89131C0.758444 5.7135 1.21243 4.59454 1.9068 3.62703C2.60117 2.65951 3.51595 1.87126 4.57545 1.32749C5.63495 0.783715 6.80871 0.500063 7.99961 0.5ZM7.99961 2.5C6.54091 2.5 5.14197 3.07946 4.11052 4.11091C3.07907 5.14236 2.49961 6.54131 2.49961 8C2.49961 9.45869 3.07907 10.8576 4.11052 11.8891C5.14197 12.9205 6.54091 13.5 7.99961 13.5C9.4583 13.5 10.8572 12.9205 11.8887 11.8891C12.9201 10.8576 13.4996 9.45869 13.4996 8C13.4996 6.54131 12.9201 5.14236 11.8887 4.11091C10.8572 3.07946 9.4583 2.5 7.99961 2.5Z" fill="#707070"/>
                </svg>
            </div>
            <input type="text" class="form-control search-fields" placeholder="Search fields" autocomplete="off">
        </div>
    </div>
    <div class="body scroll-div" id="freshdesk-fillter">
        {{--                            <div class="form-group agents">--}}
        {{--                                <label for="agents" class="form-label"> agents </label>--}}
        {{--                                <select name="" id="agents" class="form-control">--}}
        {{--                                    <option value="" disabled selected> select agents .. </option>--}}
        {{--                                       @foreach( $all_agents as $agent )--}}
        {{--                                    <option value="2">--}}
        {{--                                        Test--}}
        {{--                                    </option>--}}
        {{--                                          @endforeach--}}
        {{--                                </select>--}}
        {{--                            </div>--}}
        <div class="form-group groups">
            <label for="groups" class="form-label"> groups </label>
            <select name="group_id" id="group_id" class="form-control">
                <option value="0" selected> select groups .. </option>
                @foreach( $groups as $group )
                    <option value="{{ $group->id }}">
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
        </div>




        <div class="form-group status">
            <label for="status" class="form-label"> Status </label>
            <select name="status" id="status" class="form-control">
                <option value=""> any status</option>
                @if($status->count()>0)
                    @foreach($status as $item)
                        <option value="{{$item->id}}"  > {{$item->name_en}} </option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group priority">
            <label for="priority" class="form-label">priority</label>
            <select name="priority" id="priority" class="form-control">
                <option value="">any priority</option>
                @if($priority->count()>0)
                    @foreach($priority as $item)
                        <option value="{{$item->id}}"> {{$item->name_en}} </option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group type">
            <label for="type" class="form-label"> Type </label>
            <select name="" id="type" class="form-control">
                <option value=""> any type</option>
                @if($type->count()>0)
                    @foreach($type as $item)
                        <option value="{{$item->id}}"  > {{$item->name_en}} </option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="form-group tags">
            <label for="tags" class="form-label"> Tags </label>
            <select name="" id="tag" class="form-control">
                <option value="">any tags</option>
                @if($tags->count()>0)
                    @foreach($tags as $item)
                        <option value="{{$item->id}}" > {{$item->name_en}} </option>
                    @endforeach
                @endif
            </select>
        </div>


    </div>
    {{--                        <div class="footer d-flex gap-4">--}}
    {{--                            <button type="submit" class="btn btn-theme mr-3" id="side-filter">--}}
    {{--                                Apply--}}
    {{--                            </button>--}}
    {{--                            <button type="submit" class="btn btn-danger border" id="side-filter-reset">--}}
    {{--                                Reset--}}
    {{--                            </button>--}}
    {{--                        </div>--}}
</div>
