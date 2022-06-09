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
  init() {
    this.loadMore();
  },
};

$(document).ready(function () {
  GUI.init();
});
