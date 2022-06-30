
$('.maincontent').load('page/page_1.php', function () { });
// ==========================================
let FUNC = {
    save: function (param) {
        console.log(param);
    }
}
// ==========================================
let GUI = {
    change_page: function () {
        $('body').on('click', '.mainlink', function () {
            let url = $(this).data('page');
            $.ajax({
                url: url,
                type: 'POST',
                data: {},
                dateType: 'HTML',
                beforeSend: function () {
                    $(".maincontent").fadeOut();
                    $("#main-page").animate({
                        width: "25px",
                        height: "375px"
                    }, function () {
                        $(this).animateRotate(90);
                    });

                    setTimeout(function () {
                        $("#main-page").fadeOut();
                    }, 500);
                },
                success: function (result) {
                    setTimeout(function () {
                        $("#main-page").animateRotate(0, 0);
                        $("#main-page").css("height", "25px");
                        $("#main-page").css("width", "375px");
                        $("#main-page").fadeIn();
                        $("#main-page").animate({
                            height: "100vh"
                        }, function () {
                            $(this).animate({
                                width: "100%"
                            }, function () {
                                $(".maincontent").fadeIn(300);
                            });
                        });
                        $(".maincontent").html(result);
                    }, 1000);
                }
            });
        });
    },
    init() {
        this.change_page();
    },
};
$(document).ready(function () {
    GUI.init();
});