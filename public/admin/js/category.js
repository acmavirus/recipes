// FUNC SYSTEM
const FUNC = {
	ajax_load: function (url, request, type) {
		let data = [];
		$.ajax({
			type: 'POST',
			url: url,
			data: request,
			dataType: type,
			async: false,
			success: function (content) {
				data = content;
			}
		});
		return data;
	},
	even_changetoslug: function (title) {
		var slug;
		//Đổi chữ hoa thành chữ thường
		slug = title.toLowerCase();
		//Đổi ký tự có dấu thành không dấu
		slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
		slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
		slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
		slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
		slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
		slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
		slug = slug.replace(/đ/gi, 'd');
		//Xóa các ký tự đặt biệt
		slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
		//Đổi khoảng trắng thành ký tự gạch ngang
		slug = slug.replace(/ /gi, "-");
		//Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
		//Phòng trường hợp người nhập vào quá nhiều ký tự trắng
		slug = slug.replace(/\-\-\-\-\-/gi, '-');
		slug = slug.replace(/\-\-\-\-/gi, '-');
		slug = slug.replace(/\-\-\-/gi, '-');
		slug = slug.replace(/\-\-/gi, '-');
		//Xóa các ký tự gạch ngang ở đầu và cuối
		slug = '@' + slug + '@';
		slug = slug.replace(/\@\-|\-\@|\@/gi, '');
		//In slug ra textbox có id “slug”
		return slug;
	},
};

const CATEGORY = {
	submit_offer_item: function () {
		$(document).on("change", ".dropdown-menu input", function (e) {
			let _this = $(this);
			e.preventDefault();
			let yourArray = [];
			$("input:checkbox[name=show]:not(:checked)").each(function () {
				yourArray.push($(this).val());
			});
			$.each(yourArray, function (key, value) {
				$("#tableContent").find("." + value).addClass("d-none");
			});
			let yourArray2 = [];
			$("input:checkbox[name=show]:checked").each(function () {
				yourArray2.push($(this).val());
			});
			$.each(yourArray2, function (key, value) {
				$("#tableContent").find("." + value).removeClass("d-none");
			});
		});
	},
	submit_form: function () {
		$('body').on('submit', '#form-add-row', function (e) {
			e.preventDefault();
			data = $(this).serialize() + '&page=' + $(".pagination .active a").text();
			$.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data: data,
				dataType: 'JSON',
				async: false,
				success: function (data) {
					if (data.status == 'error') {
						$.each(data.data, function (index, value) {
							$("#form-add-row").find("#status_" + index + "").html(value);
						});
					} else {
						$('#modalNewRow').modal('hide');
						let rs = FUNC.ajax_load(base_url + 'admin/' + __page + '/index/' + data.data.page, {}, 'HTML');
						rs = $(rs).find("#tableContent").html();
						$("#tableContent").html(rs);
					}
				}
			});
		});
		$('body').on('submit', '#form-edit-row', function (e) {
			e.preventDefault();
			data = $(this).serialize() + '&id=' + $(this).data('id') + '&page=' + $(".pagination .active a").text();
			$.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data: data,
				dataType: 'JSON',
				async: false,
				success: function (data) {
					if (data.status == 'error') {
						$.each(data.data, function (index, value) {
							$("#form-edit-row").find("#status_" + index + "").html(value);
						});
					} else {
						$('#modalNewRow').modal('hide');
						let rs = FUNC.ajax_load(base_url + 'admin/' + __page + '/index/' + data.data.page, {}, 'HTML');
						rs = $(rs).find("#tableContent").html();
						$("#tableContent").html(rs);
						tinyMCE.activeEditor.setContent('');
					}
				}
			});
		});
	},
	action_row: function () {
		/* add
		------------------------------------------------------------------------- */
		$('body').on('click', '#openAdd', function (e) {
			$("#modalNewRow form").attr("action", base_url + 'admin/' + __page + '/add');
			$("#modalNewRow form").attr('id', 'form-add-row');
		});
		/* delete
		------------------------------------------------------------------------- */
		$('body').on('click', '#action a', function (e) {
			$("#modalID").val($(this).data('id'));
			let page = $(".pagination .active a").text();
			$('#modalDeleteRow').on('click', '.deleteItem', function () {
				var param = {
					id: $("#modalID").val(),
					page: page
				};
				$.ajax({
					type: 'POST',
					url: base_url + 'admin/' + __page + '/delete',
					data: param,
					dataType: 'JSON',
					async: false,
					success: function (data) {
						let rs = FUNC.ajax_load(base_url + 'admin/' + __page + '/index/' + page, {}, 'HTML');
						rs = $(rs).find("#tableContent").html();
						$("#tableContent").html(rs);
					}
				});
			});
		});
		/* edit
		------------------------------------------------------------------------- */
		$('body').on('click', '#action a', function (e) {
			$("#modalNewRow form").attr('id', 'form-edit-row');
			$("#form-edit-row").attr("data-id", $(this).data('id'));
			$("#form-edit-row").attr("action", base_url + 'admin/' + __page + '/edit');
			let param = {
				id: $(this).data('id')
			};
			let API = FUNC.ajax_load(base_url + 'admin/' + __page + '/getRow', param, 'JSON');
			$.each(API, function (key, value) {
				switch (key) {
					case 'content':
						tinymce.activeEditor.setContent('');
						if(value !== null) tinymce.activeEditor.setContent(value);
					default:
						$("#form-edit-row").find("input[name=" + key + "]").val('');
						$("#form-edit-row").find("input[name=" + key + "]").val(value);
				}

			});
			// moxie selector
			$('body').on('click', '#modalEditRow .iframe-btn', function (e) {
				moxman.browse({
					oninsert: function (args) {
						let url = args.files[0].path;
						$("#modalEditRow").find("#icon").val(url);
					}
				});
			});
		});
	},
	pagination: function () {
		$('body').on('click', '.pagination a', function (e) {
			e.preventDefault();
			let page = $(this).data('ci-pagination-page');
			let data = FUNC.ajax_load(base_url + 'admin/' + __page + '/index/' + page, {}, 'HTML');
			data = $(data).find("#tableContent").html();
			$("#tableContent").html(data);
		});
	},
	init: function () {
		this.submit_offer_item();
		this.submit_form();
		this.action_row();
		this.pagination();
	}
};

$(document).ready(function () {
	CATEGORY.init();
});
