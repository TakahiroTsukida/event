//遷移時のアニメーション
// $(function() {
//     const loader = $("#loader-wrap");
//     //ページ遷移時に発動
//     //ページの読み込みが完了したらアニメーションを非表示
//     $(window).on('load', function () {
//         loader.fadeOut();
//     });
//
//     //押したときに発動
//     $("a").on("click", function () {
//         loader.fadeIn();
//     });
//     $('form').submit(function () {
//         loader.fadeIn();
//     });
// });

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

//都道府県市区町村select
$(function($) {
    const prefId = $('#prefId').data('pref-id');
    const cityId = $('#cityId').data('city-id');
    if (typeof prefId !== 'undefined') {
        $.getJSON('/json/pref_city.json', function (data) {
            for (let i = 0; i < 47; i++) {
                let code = i + 1;
                code = ('00' + code).slice(-2); // ゼロパディング
                if (code == prefId) {
                    $('#select-pref').append('<option value="' + code + '" selected>' + data[i][code].pref + '</option>');
                } else {
                    $('#select-pref').append('<option value="' + code + '">' + data[i][code].pref + '</option>');
                }
            }
            if (prefId !== "") {
                let select_pref = ('00' + $('#select-pref option:selected').val()).slice(-2);
                let key = Number(select_pref) - 1;
                for (let i = 0; i < data[key][select_pref].city.length; i++) {
                    if (data[key][select_pref].city[i].id == cityId) {
                        $('#select-city').append('<option value="' + data[key][select_pref].city[i].id + '" selected>' + data[key][select_pref].city[i].name + '</option>');
                    } else {
                        $('#select-city').append('<option value="' + data[key][select_pref].city[i].id + '">' + data[key][select_pref].city[i].name + '</option>');
                    }
                }
            }
        });
    }

    // 都道府県メニューに連動した市区町村フォーム生成
    $('#select-pref').on('change', function() {
        $('#select-city option:nth-child(n+2)').remove(); // ※1 市区町村フォームクリア
        let select_pref = ('00'+$('#select-pref option:selected').val()).slice(-2);
        let key = Number(select_pref)-1;
        $.getJSON('/json/pref_city.json', function(data) {
            for(let i=0; i<data[key][select_pref].city.length; i++){
                $('#select-city').append('<option value="'+data[key][select_pref].city[i].id+'">'+data[key][select_pref].city[i].name+'</option>');
            }
        });
    });
});

