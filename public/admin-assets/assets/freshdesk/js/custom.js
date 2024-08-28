
    /*------------------------------- 
        btn toggle 
    -------------------------------*/

    $(".btn-freshdesk-fillter").on("click",function(){
        $(".freshdesk-fillter").toggleClass("active");
    });

    $(".btn-freshdesk-contact").on("click",function(){
        $(".freshdesk-contact").toggleClass("active");
    });

    $(".btn-edit").on("click",function(){
        $(".freshdesk-update").toggleClass("active");
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