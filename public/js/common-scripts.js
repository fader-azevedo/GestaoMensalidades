/*---LEFT BAR ACCORDION----*/
$(document).ready(function() {
    /*grafico de barras*/
    if ($(".custom-bar-chart")) {
        $(".bar").each(function () {
            var i = $(this).find(".value").html();
            $(this).find(".value").html("");
            $(this).find(".value").animate({
                height: i
            }, 2000)
        })
    }
    /*Notificaoes*/
    $('.btn-Notification2').on('click', function(){
        var NotificationArea=$('.NotificationArea');
        if(NotificationArea.hasClass('NotificationArea-show')){
            NotificationArea.removeClass('NotificationArea-show');
        }else{
            NotificationArea.addClass('NotificationArea-show');
        }
    });
    $('.btn-Notification').on('click', function(){
        var NotificationArea=$('.NotificationArea');
        if(NotificationArea.hasClass('NotificationArea-show')){
            NotificationArea.removeClass('NotificationArea-show');
        }else{
            NotificationArea.addClass('NotificationArea-show');
        }
    });

    function myNavFunction(id) {
        $("#date-popover").hide();
        var nav = $("#" + id).data("navigation");
        var to = $("#" + id).data("to");
        console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }


    $('#nav-accordion').dcAccordion({
        eventType: 'click',
        autoClose: true,
        saveState: true,
        disableLink: true,
        speed: 'slow',
        showCount: false,
        autoExpand: true,
//        cookie: 'dcjq-accordion-1',
        classExpand: 'dcjq-current-parent'
    });
    //
    // $("#date-popover").popover({html: true, trigger: "manual"});
    // $("#date-popover").hide();
    // $("#date-popover").click(function (e) {
    //     $(this).hide();
    // });
    //
    // $("#my-calendar").zabuto_calendar({
    //     action: function () {
    //         return myDateFunction(this.id, false);
    //     },
    //     action_nav: function () {
    //         return myNavFunction(this.id);
    //     },
    //     ajax: {
    //         url: "show_data.php?action=1",
    //         modal: true
    //     },
    //     legend: [
    //         {type: "text", label: "Special event", badge: "00"},
    //         {type: "block", label: "Regular event", }
    //     ]
    // });

// });
//
// var Script = function () {


//    sidebar dropdown menu auto scrolling

    jQuery('#sidebar .sub-menu > a').click(function () {
        var o = ($(this).offset());
        diff = 250 - o.top;
        if(diff>0)
            $("#sidebar").scrollTo("-="+Math.abs(diff),500);
        else
            $("#sidebar").scrollTo("+="+Math.abs(diff),500);
    });

//    sidebar toggle
    $(function() {
        function responsiveView() {
            var wSize = $(window).width();
            if (wSize <= 768) {
                $('#container').addClass('sidebar-close');
                $('#sidebar > ul').hide();
            }

            if (wSize > 768) {
                $('#container').removeClass('sidebar-close');
                $('#sidebar > ul').show();
            }
        }
        $(window).on('load', responsiveView);
        $(window).on('resize', responsiveView);
    });

    $('#butNav').click(function () {
        if ($('#sidebar > ul').is(":visible") === true) {
            $('#main-content').css({
                'margin-left': '0px','transition': 'all .2s ease'
            });
            $('#sidebar').css({
                'margin-left': '-210px','transition': 'all .2s ease'
            });
            $('#sidebar > ul').hide();
            $("#container").addClass("sidebar-closed");
            $("#container").css({'transition': 'all .2s ease'});
        } else {
            $('#main-content').css({
                'margin-left': '210px','transition': 'all .2s ease'
            });
            $('#sidebar > ul').show();
            $('#sidebar').css({
                'margin-left': '0','transition': 'all .2s ease'
            });
            $("#container").removeClass("sidebar-closed");
        }
    });

    /**/


// custom scrollbar
    $("#sidebar").niceScroll({styler:"fb",cursorcolor:"#4ECDC4", cursorwidth: '3', cursorborderradius: '10px', background: '#404040', spacebarenabled:false, cursorborder: ''});

    $("html").niceScroll({styler:"fb",cursorcolor:"#4ECDC4", cursorwidth: '6', cursorborderradius: '10px', background: '#404040', spacebarenabled:false,  cursorborder: '', zindex: '1000'});

// widget tools

    jQuery('.panel .tools .fa-chevron-down').click(function () {
        var el = jQuery(this).parents(".panel").children(".panel-body");
        if (jQuery(this).hasClass("fa-chevron-down")) {
            jQuery(this).removeClass("fa-chevron-down").addClass("fa-chevron-up");
            el.slideUp(200);
        } else {
            jQuery(this).removeClass("fa-chevron-up").addClass("fa-chevron-down");
            el.slideDown(200);
        }
    });

    jQuery('.panel .tools .fa-times').click(function () {
        jQuery(this).parents(".panel").parent().remove();
    });


//    tool tips

    // $('.tooltips').tooltip();

//    popovers

    // $('.popovers').popover();


});