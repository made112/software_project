@extends('admin.layout.master_layout')
@section('title')
    {{ trans('lang.tickets_title') }}
@stop
@section('css')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap">
    <link rel="stylesheet" href="{{ asset('admin-assets/assets/freshdesk/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/assets/freshdesk/css/custom.css') }}">
@stop
@section('page-content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper mb-0">
        <!-- BEGIN: Subheader -->

        <!-- END: Subheader -->
        <div class="m-content mb-3">

            <div class="row">

                <div class="col-lg-12">

                    <div class="m-subheader p-0 ">
                        <div class="d-flex align-items-center">
                            <div class="mr-auto">
                                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                                    <li class="m-nav__item m-nav__item--home">
                                        <a href="#" class="m-nav__link m-nav__link--icon">
                                            <i class="m-nav__link-icon la la-home text-dark"></i>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="/admin/dashboard" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark"
                                                  style="font-weight:bold">{{ trans('lang.dashboard') }}</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text">/</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark">{{ trans('lang.tickets_page') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="m-demo__preview  m-demo__preview--btn">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @if( count($tickets) > 0 )
            <section class="freshdesk">
                <div class="freshdesk-wrapper">
                    <div class="freshdesk-contact h-100">
                        <div class="head">
                            <div class="search-box">
                                <div class="icon">
                                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.99961 0.5C9.39758 0.499944 10.7678 0.890614 11.9555 1.62792C13.1432 2.36523 14.1012 3.41983 14.7214 4.6727C15.3416 5.92558 15.5993 7.32686 15.4654 8.71841C15.3315 10.11 14.8113 11.4364 13.9636 12.548L18.7066 17.293C18.886 17.473 18.9901 17.7144 18.9978 17.9684C19.0056 18.2223 18.9164 18.4697 18.7484 18.6603C18.5803 18.8508 18.3461 18.9703 18.0931 18.9944C17.8402 19.0185 17.5876 18.9454 17.3866 18.79L17.2926 18.707L12.5476 13.964C11.6006 14.6861 10.4953 15.1723 9.32305 15.3824C8.15083 15.5925 6.94543 15.5204 5.80661 15.1721C4.66778 14.8238 3.62826 14.2094 2.77406 13.3795C1.91986 12.5497 1.27555 11.5285 0.894433 10.4002C0.513317 9.27192 0.406356 8.06912 0.5824 6.89131C0.758444 5.7135 1.21243 4.59454 1.9068 3.62703C2.60117 2.65951 3.51595 1.87126 4.57545 1.32749C5.63495 0.783715 6.80871 0.500063 7.99961 0.5ZM7.99961 2.5C6.54091 2.5 5.14197 3.07946 4.11052 4.11091C3.07907 5.14236 2.49961 6.54131 2.49961 8C2.49961 9.45869 3.07907 10.8576 4.11052 11.8891C5.14197 12.9205 6.54091 13.5 7.99961 13.5C9.4583 13.5 10.8572 12.9205 11.8887 11.8891C12.9201 10.8576 13.4996 9.45869 13.4996 8C13.4996 6.54131 12.9201 5.14236 11.8887 4.11091C10.8572 3.07946 9.4583 2.5 7.99961 2.5Z" fill="#707070"/>
                                    </svg>
                                </div>
                                <input type="search" class="form-control search-contact" placeholder="Search" autocomplete="off">
                            </div>
                        </div>
                        <div class="body scroll-div" id="freshdesk-contact">
                            @if ( count($company_tickets) > 0 )
                                @foreach( $company_tickets as $ticket )
                                    <div class="contact-card client-contact" data-id="{{ $ticket->client->id }}" id="client-contact">
                                        <div class="pic">
                                            <img src="{{ $ticket->client->logo }}" alt="">
                                        </div>
                                        <div class="content">
                                            <div class="contact-name">
                                                {{ $ticket->client->name }}
                                            </div>
                                            <div class="last-msg">
                                                {{ $ticket->client->email }}
                                            </div>
                                        </div>
                                        <div class="date"> {{ ($ticket->updated_at)->format('H:i') }} </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="contact-card client-contact text-center d-flex" style="display: block !important" data-id="0" id="client-contact">
                                    <span class="text-center text-danger" style="font-size: 20px;">
                                        No Data
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="freshdesk-tickets">
                        <div class="head pt-0">
                            <div class="title"> All Tickets </div>
                            <div class="option">
                                <select name="condition" id="condition" class="form-control custom-select">
                                    <option value="" > All </option>
                                    <option value="1" > New </option>
                                    <option value="2" > Updated </option>
                                    <option value="3" > Overdue </option>
                                    <option value="4" > Closed </option>
                                </select>
                                <div class="btn-option">
                                    <div class="btn btn-freshdesk-contact">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.0007 10.0003C12.3018 10.0003 14.1673 8.13485 14.1673 5.83366C14.1673 3.53247 12.3018 1.66699 10.0007 1.66699C7.69946 1.66699 5.83398 3.53247 5.83398 5.83366C5.83398 8.13485 7.69946 10.0003 10.0007 10.0003Z" stroke="#191919" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M17.1585 18.3333C17.1585 15.1083 13.9501 12.5 10.0001 12.5C6.05013 12.5 2.8418 15.1083 2.8418 18.3333" stroke="#191919" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div class="btn btn-freshdesk-fillter">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.49971 1.75H15.4997C15.9413 1.75132 16.3645 1.92734 16.6768 2.23961C16.989 2.55189 17.1651 2.97504 17.1664 3.41667V5.25C17.118 5.96587 16.8235 6.643 16.333 7.16667L12.7497 10.3333C12.491 10.5818 12.2841 10.8792 12.141 11.2082C11.998 11.5372 11.9216 11.8913 11.9164 12.25V15.8333C11.9052 16.1105 11.832 16.3817 11.7022 16.6268C11.5724 16.872 11.3893 17.0849 11.1664 17.25L9.99971 18C9.74462 18.1558 9.45293 18.2416 9.15409 18.2485C8.85526 18.2555 8.55987 18.1835 8.29778 18.0398C8.03569 17.8961 7.81617 17.6857 7.66141 17.43C7.50665 17.1742 7.42213 16.8822 7.41638 16.5833V12.1667C7.37239 11.5302 7.14035 10.9211 6.74971 10.4167L3.58304 7.08333C3.15119 6.62896 2.8867 6.04123 2.83304 5.41667V3.5C2.82526 3.27508 2.86244 3.05086 2.94239 2.84048C3.02235 2.63011 3.14349 2.4378 3.2987 2.27483C3.45391 2.11186 3.64008 1.98149 3.84631 1.89137C4.05254 1.80125 4.27467 1.75319 4.49971 1.75V1.75Z" stroke="#191919" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="btn btn-freshdesk-fillter">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.49971 1.75H15.4997C15.9413 1.75132 16.3645 1.92734 16.6768 2.23961C16.989 2.55189 17.1651 2.97504 17.1664 3.41667V5.25C17.118 5.96587 16.8235 6.643 16.333 7.16667L12.7497 10.3333C12.491 10.5818 12.2841 10.8792 12.141 11.2082C11.998 11.5372 11.9216 11.8913 11.9164 12.25V15.8333C11.9052 16.1105 11.832 16.3817 11.7022 16.6268C11.5724 16.872 11.3893 17.0849 11.1664 17.25L9.99971 18C9.74462 18.1558 9.45293 18.2416 9.15409 18.2485C8.85526 18.2555 8.55987 18.1835 8.29778 18.0398C8.03569 17.8961 7.81617 17.6857 7.66141 17.43C7.50665 17.1742 7.42213 16.8822 7.41638 16.5833V12.1667C7.37239 11.5302 7.14035 10.9211 6.74971 10.4167L3.58304 7.08333C3.15119 6.62896 2.8867 6.04123 2.83304 5.41667V3.5C2.82526 3.27508 2.86244 3.05086 2.94239 2.84048C3.02235 2.63011 3.14349 2.4378 3.2987 2.27483C3.45391 2.11186 3.64008 1.98149 3.84631 1.89137C4.05254 1.80125 4.27467 1.75319 4.49971 1.75V1.75Z" stroke="#191919" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- <div class="body scroll-div" id="freshdesk-tickets-body"> -->
                        <div class="body scroll-div" id="test_here">
                            @include('admin.tickets.tickets')
                        </div>
                    </div>


                    @include('admin.tickets.modal')

                </div>
            </section>
        @else
            <section class="freshdesk">
                <div class="freshdesk-wrapper">
                    <div class="freshdesk-tickets">
                        <!-- <div class="body scroll-div" id="freshdesk-tickets-body"> -->
                        <div class="body no-ticket">
                            <div class="no-ticket-card">
                                <div class="pic">
                                    <img src="{{ asset('admin-assets/assets/freshdesk/img/no-ticket.svg') }}" class="img-fluid" alt="">
                                </div>
                                <div class="content">
                                    <h2 class="title"> No Tickets </h2>
                                    <p class="info" style="font-size: 18px"> You don't have any Tickets yet</p>
                                    <!-- <a href="#!" class="btn btn-theme"> Start Conversation </a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif


    </div>
@endsection
@section('js')
    <script src="{{ asset('admin-assets/assets/freshdesk/js/perfect-scrollbar.min.js') }}"></script>
    <script>

        function getUrl(url){
            $('.client-contact').click(function() {
                id = $(this).data('id');


                $('.client-contact').removeClass("active");
                $(this).addClass(" active");
                $.ajax({
                    url: url,
                    data: {
                        id: id,
                    }
                }).done(function(data) {
                    if( data ){
                        $('#test_here').empty().html(data);
                    }
                })

            });

            $('#condition').change(function() {
                condition = $('#condition').val();
                $.ajax({
                    url: url,
                    data: {
                        condition: condition,
                    }
                }).done(function(data) {
                    if( data ){
                        $('#test_here').empty().html(data);
                    }
                })
            });
            $('#priority').change(function() {
                priority = $('#priority').val();
                $.ajax({
                    url: url,
                    data: {
                        priority: priority,
                    }
                }).done(function(data) {
                    if( data ){
                        $('#test_here').empty().html(data);
                    }
                })
            });
            $('#status').change(function() {
                status = $('#status').val();
                $.ajax({
                    url: url,
                    data: {
                        status: status,
                    }
                }).done(function(data) {
                    if( data ){
                        $('#test_here').empty().html(data);
                    }
                })
            });
            $('#type').change(function() {
                type = $('#type').val();
                $.ajax({
                    url: url,
                    data: {
                        type: type,
                    }
                }).done(function(data) {
                    if( data ){
                        $('#test_here').empty().html(data);
                    }
                })
            });
            $('#tag').change(function() {
                tag = $('#tag').val();
                $.ajax({
                    url: url,
                    data: {
                        tag: tag,
                    }
                }).done(function(data) {
                    if( data ){
                        $('#test_here').empty().html(data);
                    }
                })
            });
            $('#group_id').change(function() {
                group_id = $('#group_id').val();
                $.ajax({
                    url: url,
                    data: {
                        group_id: group_id,
                    }
                }).done(function(data) {
                    if( data ){
                        $('#test_here').empty().html(data);
                    }
                })
            });

            $('.search-contact').input(function() {
                name = $(this).val();
                if (name == '' || name.length >= 3) {

                    $.ajax({
                        url: url,
                        data: {
                            name: name,
                        }
                    }).done(function(data) {
                        if( data ){
                            $('#client-contact').empty().html(data);
                        }
                    })
                }

            })

        }

        $(document).ready(function () {
            url = $(this).attr('href');
            getUrl(url)
        })

    </script>
    <script>

        /*-------------------------------
            btn toggle
        -------------------------------*/

        $(".btn-freshdesk-fillter").on("click",function(){
            $(".freshdesk-fillter").toggleClass("active");
        });

        $(".btn-freshdesk-contact").on("click",function(){
            $(".freshdesk-contact").toggleClass("active");
        });

        /*-------------------------------
            PerfectScrollbar
        -------------------------------*/

        $(".scroll-div").each( function(){
            const ps = new PerfectScrollbar( "#"+ this.id, {
                wheelSpeed: 2,
                wheelPropagation: true,
                minScrollbarLength: 20
            });
        });

        /*-------------------------------
            priority
        -------------------------------*/

        $(document).on("click",".btn-priority", function(){
            var priorityColor   = $(this).data("color"),
                priorityText    = $(this).data("text"),
                priorityID      = $(this).data("id"),
                ticketID        = $(this).data("ticket-id");

            $(this).parents(".dropdown-priority").find(".dropdown-menu .btn-priority").removeClass("active");
            $(this).parents(".dropdown-priority").find(".btn-priority-box .dot").css("background-color", priorityColor);
            $(this).parents(".dropdown-priority").find(".btn-priority-box .text").text(priorityText);
            $(this).parents(".dropdown-priority").find(".priorityID").val(priorityID);
            $(this).parents(".dropdown-priority").find('.dropdown-menu').toggleClass('show');
            $(this).addClass("active");

            // ajax code =)
            //send ticketID by ajax code to change his priority
        });

        /*-------------------------------
            status
        -------------------------------*/

        $(document).on("click",".btn-status", function(){
            var statusText    = $(this).data("text"),
                statusID      = $(this).data("id"),
                ticketID      = $(this).data("ticket-id");

            $(this).parents(".dropdown-status").find(".dropdown-menu .btn-status").removeClass("active");
            $(this).parents(".dropdown-status").find(".btn-status-box .text").text(statusText);
            $(this).parents(".dropdown-status").find(".statusID").val(statusID);
            $(this).parents(".dropdown-status").find('.dropdown-menu').toggleClass('show');
            $(this).addClass("active");

            // ajax code =)
            //send ticketID by ajax code to change his status
        });

        /*-------------------------------
            select-group
        -------------------------------*/

        $(document).on("click",".select-group", function(){
            var groupName   = $(this).data("group-name"),
                groupID     = $(this).data("group-id"),
                ticketID    = $(this).data("ticket-id");

            $(this).parents(".dropdown-user").find(".dropdown-menu .select-group").removeClass("active");
            $(this).parents(".dropdown-user").find(".group-name").text(groupName);
            $(this).parents(".dropdown-user").find(".groupID").val(groupID);
            $(this).parents(".dropdown-user").find('.nav-tab-user li:last-child div').trigger('click');
            $(this).addClass("active");



            // ajax code =)
            //send ticketID by ajax code to change his status
        });

        /*-------------------------------
            select-agent
        -------------------------------*/

        $(document).on("click",".select-agent", function(){
            var agentName   = $(this).data("agent-name"),
                agentID     = $(this).data("agent-id"),
                ticketID    = $(this).data("ticket-id");

            $(this).parents(".dropdown-user").find(".dropdown-menu .select-agent").removeClass("active");
            $(this).parents(".dropdown-user").find(".agent-name").text(agentName);
            $(this).parents(".dropdown-user").find(".agentID").val(agentID);
            $(this).parents(".dropdown-user").find('.dropdown-menu').toggleClass('show');
            $(this).addClass("active");

            // ajax code =)
            //send ticketID by ajax code to change his status
        });

        /*-------------------------------
            search-contact
        -------------------------------*/

        $(".search-contact").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".freshdesk-contact .body .contact-name").filter(function() {
                $(this).parents(".contact-card").toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        /*-------------------------------
            search-fields
        -------------------------------*/

        var newHeight = $(".freshdesk-fillter .body").height() - 40;
        $(".search-fields").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".freshdesk-fillter .body .form-label").filter(function() {
                $(".freshdesk-fillter .body").css("height", newHeight + "px");
                $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        /*-------------------------------
            search-fields
        -------------------------------*/

        $(document).on('click', '.dropdown-menu', function (e) {
            e.stopPropagation();
        });

        /*-------------------------------
            search-fields
        -------------------------------*/

        $(document).mouseup(function(e){
            var container = $(".freshdesk-contact.active");
            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && container.has(e.target).length === 0){
                container.parent().removeClass("active");
            }
        });

    </script>




@endsection
