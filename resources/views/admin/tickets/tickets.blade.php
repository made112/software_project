@if( count($tickets) > 0 )
    @foreach( $tickets as $ticket )
    <div class="tickets-card" >
        <a href="{{ route('ticket.show', ['id' => $ticket->id]) }}" class="pic">
            @if($ticket->client->logo)
                <img src="{{ $ticket->client->logo }}" alt="">
            @elseif($ticket->client->logo)
                <img src="{{ asset('admin-assets/assets/freshdesk/img/user-1.png') }}" alt="">
            @endif
        </a>
        <a href="{{ route('ticket.show', ['id' => $ticket->id]) }}" class="content">
            @if($ticket->condition == 1)
                <div class="status new">
                    {{ 'New' }}
                </div>
            @elseif( $ticket->condition == 2 )
                <div class="status updated">
                    {{ 'Updated' }}
                </div>
            @elseif($ticket->condition == 3)
                <div class="status overdue">
                    {{ 'Overdue' }}
                </div>
            @elseif($ticket->condition == 4 && $ticket->status == 4)
                <div class="status overdue">
                    {{ 'Close' }}
                </div>
            @elseif($ticket->condition == 5 )
                <div class="status new" style="background: #6c757d; border: 1px solid #6c757d; color: #fbfdff;">
                    {{ 'Restore' }}
                </div>
            @endif
            <div class="username">
                {{ $ticket->client->name }}
            </div>
            <div class="company d-none">
                {{ $ticket->client->name }}
            </div>
            <div class="info">
                {{ Str::limit($ticket->description) }}
            </div>
            <div class="date">
                {{ $ticket->updated_at->diffForHumans() }}
            </div>
        </a>

        <div class="option">
            <!-- priority -->
            <div class="dropdown dropdown-priority">
                <div class="btn-priority btn-priority-box dropdown-toggle" id="dropdown-priority" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if($ticket->priority == 1)
                        <span class="dot" style="background: #2390F5;"></span>
                        <span class="text"> low </span>
                    @elseif($ticket->priority == 2)
                        <span class="dot" style="background: #70D274;"></span>
                        <span class="text"> medium </span>
                    @elseif($ticket->priority == 3)
                        <span class="dot" style="background: #FF0000;"></span>
                        <span class="text"> high </span>
                    @elseif($ticket->priority == 4)
                        <span class="dot" style="background: #FF0000;"></span>
                        <span class="text"> Agent </span>
                    @endif
                </div>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-priority">

                        <div class="dropdown-item btn-priority" data-ticket-id="1" data-id="1" data-color="#70D274" data-text="low">
                            <span class="dot" style="background: #70D274;"></span>
                            <span class="text"> low </span>
                        </div>

                        <div class="dropdown-item btn-priority" data-ticket-id="1" data-id="2" data-color="#2390F5" data-text="medium">
                            <span class="dot" style="background: #2390F5;"></span>
                            <span class="text"> medium </span>
                        </div>

                        <div class="dropdown-item btn-priority" data-ticket-id="1" data-id="3" data-color="#FF0000" data-text="high">
                            <span class="dot" style="background: #FF0000;"></span>
                            <span class="text"> high </span>
                        </div>

                        <div class="dropdown-item btn-priority" data-ticket-id="1" data-id="4" data-color="#FF0000" data-text="urgent">
                            <span class="dot" style="background: #FF0000;"></span>
                            <span class="text"> Urgent </span>
                        </div>

                </div>
                <input type="hidden" class="priorityID">
            </div>
            <!-- user -->
            <div class="dropdown dropdown-user">
                <div class="btn-user btn-user-box dropdown-toggle" id="dropdown-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle r="4" transform="matrix(-1 0 0 1 10 7)" stroke="#3D3D3D" stroke-width="1.5"/>
                        <path d="M3 16.9347C3 16.0743 3.54085 15.3068 4.35109 15.0175V15.0175C8.00404 13.7128 11.996 13.7128 15.6489 15.0175V15.0175C16.4591 15.3068 17 16.0743 17 16.9347V18.2502C17 19.4376 15.9483 20.3498 14.7728 20.1818L13.8184 20.0455C11.2856 19.6837 8.71435 19.6837 6.18162 20.0455L5.22721 20.1818C4.0517 20.3498 3 19.4376 3 18.2502V16.9347Z" stroke="#3D3D3D" stroke-width="1.5"/>
                        <path d="M17 11H21" stroke="#3D3D3D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M19 9L19 13" stroke="#3D3D3D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="text ms-3">
                        <span class="group-name"></span>
                        <span class="mx-2">/</span>
                        <span class="agent-name"> {{ $ticket->group->name }} </span>
                    </span>
                </div>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-user" aria-labelledby="dropdown-user">
                    <ul class="nav nav-tabs nav-tab-user">

                        <li class="nav-item mx-0 ">
                            <div class="active" data-target="#group-1" data-toggle="tab">
                                <div class="title">
                                    Group
                                </div>
                            </div>
                        </li>

                        <li class="nav-item mx-0">
                            <div class="" data-target="#agent-1" data-toggle="tab">
                                <div class="title">
                                    Agent
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="group-1">
                            <div class="search-box">
                                <div class="icon">
                                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.99961 0.5C9.39758 0.499944 10.7678 0.890614 11.9555 1.62792C13.1432 2.36523 14.1012 3.41983 14.7214 4.6727C15.3416 5.92558 15.5993 7.32686 15.4654 8.71841C15.3315 10.11 14.8113 11.4364 13.9636 12.548L18.7066 17.293C18.886 17.473 18.9901 17.7144 18.9978 17.9684C19.0056 18.2223 18.9164 18.4697 18.7484 18.6603C18.5803 18.8508 18.3461 18.9703 18.0931 18.9944C17.8402 19.0185 17.5876 18.9454 17.3866 18.79L17.2926 18.707L12.5476 13.964C11.6006 14.6861 10.4953 15.1723 9.32305 15.3824C8.15083 15.5925 6.94543 15.5204 5.80661 15.1721C4.66778 14.8238 3.62826 14.2094 2.77406 13.3795C1.91986 12.5497 1.27555 11.5285 0.894433 10.4002C0.513317 9.27192 0.406356 8.06912 0.5824 6.89131C0.758444 5.7135 1.21243 4.59454 1.9068 3.62703C2.60117 2.65951 3.51595 1.87126 4.57545 1.32749C5.63495 0.783715 6.80871 0.500063 7.99961 0.5ZM7.99961 2.5C6.54091 2.5 5.14197 3.07946 4.11052 4.11091C3.07907 5.14236 2.49961 6.54131 2.49961 8C2.49961 9.45869 3.07907 10.8576 4.11052 11.8891C5.14197 12.9205 6.54091 13.5 7.99961 13.5C9.4583 13.5 10.8572 12.9205 11.8887 11.8891C12.9201 10.8576 13.4996 9.45869 13.4996 8C13.4996 6.54131 12.9201 5.14236 11.8887 4.11091C10.8572 3.07946 9.4583 2.5 7.99961 2.5Z" fill="#707070"/>
                                    </svg>
                                </div>
                                <input type="search" class="form-control search-group" placeholder="Search Group" autocomplete="off">
                            </div>

                            <div class="list scroll-div" id="group-list-1">
                                @foreach( $groups as $group )
                                    <div class="list-item select-group" data-ticket-id="1" data-group-id="1" data-group-name="billing">
                                        {{ $group->name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="agent-1">
                            <div class="search-box">
                                <div class="icon">
                                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.99961 0.5C9.39758 0.499944 10.7678 0.890614 11.9555 1.62792C13.1432 2.36523 14.1012 3.41983 14.7214 4.6727C15.3416 5.92558 15.5993 7.32686 15.4654 8.71841C15.3315 10.11 14.8113 11.4364 13.9636 12.548L18.7066 17.293C18.886 17.473 18.9901 17.7144 18.9978 17.9684C19.0056 18.2223 18.9164 18.4697 18.7484 18.6603C18.5803 18.8508 18.3461 18.9703 18.0931 18.9944C17.8402 19.0185 17.5876 18.9454 17.3866 18.79L17.2926 18.707L12.5476 13.964C11.6006 14.6861 10.4953 15.1723 9.32305 15.3824C8.15083 15.5925 6.94543 15.5204 5.80661 15.1721C4.66778 14.8238 3.62826 14.2094 2.77406 13.3795C1.91986 12.5497 1.27555 11.5285 0.894433 10.4002C0.513317 9.27192 0.406356 8.06912 0.5824 6.89131C0.758444 5.7135 1.21243 4.59454 1.9068 3.62703C2.60117 2.65951 3.51595 1.87126 4.57545 1.32749C5.63495 0.783715 6.80871 0.500063 7.99961 0.5ZM7.99961 2.5C6.54091 2.5 5.14197 3.07946 4.11052 4.11091C3.07907 5.14236 2.49961 6.54131 2.49961 8C2.49961 9.45869 3.07907 10.8576 4.11052 11.8891C5.14197 12.9205 6.54091 13.5 7.99961 13.5C9.4583 13.5 10.8572 12.9205 11.8887 11.8891C12.9201 10.8576 13.4996 9.45869 13.4996 8C13.4996 6.54131 12.9201 5.14236 11.8887 4.11091C10.8572 3.07946 9.4583 2.5 7.99961 2.5Z" fill="#707070"/>
                                    </svg>
                                </div>
                                <input type="search" class="form-control search-agent" placeholder="Search Agent" autocomplete="off">
                            </div>
                            <div class="list scroll-div" id="agent-agent-1">
                                <div class="list-item select-agent" data-ticket-id="1" data-agent-id="1" data-agent-name="alaa krunb">No Agent</div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="groupID">
                    <input type="hidden" class="agentID">
                </div>
            </div>
            <!-- status -->
            <div class="dropdown dropdown-status">
                <div class="btn-status btn-status-box dropdown-toggle" id="dropdown-status" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg width="18" height="18" viewBox="0 0 24 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9 0C9.15414 6.55797e-05 9.30451 0.0476192 9.43065 0.13619C9.5568 0.224761 9.65259 0.350047 9.705 0.495L15 15.054L17.295 8.742C17.3479 8.59761 17.4439 8.47297 17.57 8.38496C17.6961 8.29696 17.8462 8.24984 18 8.25H23.25C23.4489 8.25 23.6397 8.32902 23.7803 8.46967C23.921 8.61032 24 8.80109 24 9C24 9.19891 23.921 9.38968 23.7803 9.53033C23.6397 9.67098 23.4489 9.75 23.25 9.75H18.525L15.705 17.505C15.6524 17.6498 15.5566 17.7749 15.4305 17.8633C15.3043 17.9517 15.154 17.9991 15 17.9991C14.846 17.9991 14.6957 17.9517 14.5695 17.8633C14.4434 17.7749 14.3476 17.6498 14.295 17.505L9 2.946L6.705 9.2565C6.65235 9.40117 6.55645 9.52614 6.43032 9.61442C6.3042 9.70271 6.15396 9.75005 6 9.75H0.75C0.551088 9.75 0.360322 9.67098 0.21967 9.53033C0.0790176 9.38968 0 9.19891 0 9C0 8.80109 0.0790176 8.61032 0.21967 8.46967C0.360322 8.32902 0.551088 8.25 0.75 8.25H5.475L8.295 0.495C8.34741 0.350047 8.4432 0.224761 8.56935 0.13619C8.69549 0.0476192 8.84586 6.55797e-05 9 0Z" fill="#3D3D3D"/>
                    </svg>
                    <span class="text ml-2">
                        @if( $ticket->status == 1 )
                            {{ 'Open' }}
                        @elseif( $ticket->status == 2 )
                            {{ 'Pending' }}
                        @elseif( $ticket->status == 3 )
                            {{ 'Resolved' }}
                        @elseif( $ticket->status == 4 )
                            {{ 'Close' }}
                        @elseif( $ticket->status == 5 )
                            {{ 'Waiting On Customer' }}
                        @elseif( $ticket->status == 6 )
                            {{ 'Waiting On Third Party' }}
                        @endif
                    </span>
                </div>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-status">
                    <div class="dropdown-item btn-status" data-ticket-id="1" data-id="1" data-text="Open">
                        <span class="text"> Open </span>
                    </div>
                    <div class="dropdown-item btn-status" data-ticket-id="1" data-id="2" data-text="Pending">
                        <span class="text"> Pending </span>
                    </div>
                    <div class="dropdown-item btn-status" data-ticket-id="1" data-id="3" data-text="Pending">
                        <span class="text"> Resolved </span>
                    </div>
                    <div class="dropdown-item btn-status" data-ticket-id="1" data-id="4" data-text="Close">
                        <span class="text"> Close </span>
                    </div>
                    <div class="dropdown-item btn-status" data-ticket-id="1" data-id="5" data-text="Close">
                        <span class="text"> Waiting On Customer </span>
                    </div>
                    <div class="dropdown-item btn-status" data-ticket-id="1" data-id="6" data-text="Close">
                        <span class="text"> Waiting On Third Party </span>
                    </div>
                </div>
                <input type="hidden" class="statusID">
            </div>
        </div>
    </div>
@endforeach
@else
    <span class="text-center text-danger" style="font-size: 25px; display: block">
        No Data
    </span>
@endif
