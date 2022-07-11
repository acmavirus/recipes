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
  tabs: function () {
    // Get the last item in the path (e.g. index.php)
    let url = window.location.href;
    console.log(url);
    // Add active nav class based on url
    $("#menu a").each(function () {
      console.log($(this).attr("href"));
        if ($(this).attr("href") == url) {
            $(this).closest('li').addClass("active");
        }
    })
  },
  init() {
    this.loadMore();
    this.tabs();
  },
};

$(document).ready(function () {
  GUI.init();
});
