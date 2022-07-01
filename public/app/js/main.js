let FUC = {
  getCookie: function (cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }
}
let GUI = {
  loadMore: function () {
    if ($('button.btnLoadMore').length > 0) {
      $(document).on('click', 'button.btnLoadMore', function () {
        let el = $(this);
        let url = el.data('url');
        let page = parseInt(el.attr('data-page'));
        el.attr('disable', true);
        $.ajax({
          url: url + '/' + page,
          type: 'POST',
          beforeSend: function () {
            el.append(' <i class="fa fa-spinner fa-spin"></i>');
          },
          success: function (html) {
            let content = $(html).find("#ajax_content").html();
            if (content !== 'undefined') {
              page++;
              $('#ajax_content').html(content);
              el.attr('data-page', page);
              el.html('Xem thêm');
              $("html, body").animate({ scrollTop: 0 }, "slow");
              return false;
            } else {
              $(el).html('Hết dữ liệu !');
            }
            el.attr('disable', false);
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
          },
        });
      });
    }
  },
  backtotop: function () {
    //Scroll back to top
    var progressPath = document.querySelector('.progress-wrap path');
    var pathLength = progressPath.getTotalLength();
    progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
    progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
    progressPath.style.strokeDashoffset = pathLength;
    progressPath.getBoundingClientRect();
    progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
    var updateProgress = function () {
      var scroll = $(window).scrollTop();
      var height = $(document).height() - $(window).height();
      var progress = pathLength - scroll * pathLength / height;
      progressPath.style.strokeDashoffset = progress;
    };
    updateProgress();
    $(window).scroll(updateProgress);
    var offset = 50;
    var duration = 550;
    jQuery(window).on('scroll', function () {
      if (jQuery(this).scrollTop() > offset) {
        jQuery('.progress-wrap').addClass('active-progress');
      } else {
        jQuery('.progress-wrap').removeClass('active-progress');
      }
    });
    jQuery('.progress-wrap').on('click', function (event) {
      event.preventDefault();
      jQuery('html, body').animate({ scrollTop: 0 }, duration);
      return false;
    });
  },
  tabs: function () {
    var navBar = $('.tabs');
    navBar.on("click", "a", function () {
      navBar.find('li').removeClass('active');
      $(this).parent().addClass('active');
      let license = $(this).parent().data('license');
      document.cookie = "license=" + license;
    });

    if (FUC.getCookie('license') >= 0) {
      console.log(FUC.getCookie('license'));
      navBar.find('li').removeClass('active');
      navBar.find('li:nth-child(' + (parseInt(FUC.getCookie('license')) + 2) + ')').addClass('active');
    }
  },
  init() {
    this.loadMore();
    this.backtotop();
    this.tabs();
  },
};

$(document).ready(function () {
  GUI.init();
});

