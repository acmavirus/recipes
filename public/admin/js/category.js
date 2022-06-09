let __page = 'category';
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

const SETTINGS = {
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
		$('#form-add-row').submit(function (e) {
			e.preventDefault();
			data = $(this).serialize() + '&page='+$(".pagination .active a").text();
			$.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data: data,
				dataType: 'HTML',
				async: false,
				success: function (data) {
					$("#tableContent").html(data);
				}
			});
		});
	},
	action_row: function () {
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
					url: base_url + 'admin/'+__page+'/delete',
					data: param,
					dataType: 'HTML',
					async: false,
					success: function (data) {
						$("#tableContent").html(data);
					}
				});
			});
		});
		/* edit
		------------------------------------------------------------------------- */
		$('body').on('click', '#action a', function (e) {
			let param = {
				id: $(this).data('id')
			};
			let API = FUNC.ajax_load(base_url + 'admin/'+__page+'/getRow', param, 'JSON');
			$.each(API, function (key, value) {
				$("#modalEditRow").find("#" + key).val(value);
			});
			$('#form-edit-row').submit(function (e) {
				e.preventDefault();
				data = $(this).serialize() + '&page='+$(".pagination .active a").text();
				$.ajax({
					type: 'POST',
					url: $(this).attr('action'),
					data: data,
					dataType: 'HTML',
					async: false,
					success: function (data) {
						$("#tableContent").html(data);
					}
				});
			});
			// moxie selector
			$('body').on('click', '#modalEditRow .iframe-btn', function (e) {
				moxman.browse({
					oninsert: function(args) {
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
			let data = FUNC.ajax_load(base_url + 'admin/'+__page+'/loadPagination', {page:page}, 'HTML');
			$("#tableContent").html(data);
			console.log(data);
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
	SETTINGS.init();
});

// input:checkbox[name=show]:checked
