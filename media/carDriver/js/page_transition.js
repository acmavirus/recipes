/* JQUERY CODES
-------------------------------------------------*/

$(document).ready(function () {
    $.fn.animateRotate = function (angle, duration, easing, complete) {
        var args = $.speed(duration, easing, complete);
        var step = args.step;
        return this.each(function (i, e) {
            args.complete = $.proxy(args.complete, e);
            args.step = function (now) {
                $.style(e, 'transform', 'rotate(' + now + 'deg)');
                if (step) return step.apply(e, arguments);
            };

            $({ deg: 0 }).animate({ deg: angle }, args);
        });
    };
    $("#main-page").css("background-color", "#e74c3c");
    $("#main-page").css("height", "100vh");
    $("#main-page").css("width", "100%");
    $("#main-page").fadeIn();
    $(".maincontent").fadeIn();
});