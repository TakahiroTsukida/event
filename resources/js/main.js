// humburger-menu
$(function ($) {
    $('#burger-btn').on('click',function(){
        $('#burger-btn').toggleClass('close');
        $('#burger-btn').toggleClass('open');
        $('.nav-wrapper').toggleClass('slide-in');
        $('body').toggleClass('noscroll');
        if ($("#nav-touch-background").hasClass('off')) {
            $("#nav-touch-background").removeClass('off');
            $("#nav-touch-background").show();
        } else {
            $("#nav-touch-background").addClass('off');
            $("#nav-touch-background").hide();
        }
    });

    $('#nav-touch-background').on('click', function () {
        $('#burger-btn').toggleClass('close');
        $('#burger-btn').toggleClass('open');
        $('.nav-wrapper').toggleClass('slide-in');
        $('body').toggleClass('noscroll');
        $("#nav-touch-background").addClass('off');
        $("#nav-touch-background").hide();
    });
});

//
// $(function ($) {
//     $('#js-calendar').on('click', function () {
//         if ($("#calendar-background").hasClass('off')) {
//             $("#calendar-background").removeClass('off');
//             $("#calendar-background").addClass('on');
//             $("#calendar-background").show();
//         }
//     });
//
//
//
//     $(document).not('.vdp-datepicker__calendar').on('click', function () {
//         if ($("#calendar-background").hasClass('off')) {
//             $("#calendar-background").removeClass('off');
//             $("#calendar-background").show();
//         } else {
//             console.log("押したぜ");
//             $("#calendar-background").removeClass('on');
//             $("#calendar-background").hide();
//         }
//     });
//
//
//
//
//
// });
