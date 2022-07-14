jQuery(function ($) {
	/* nested sortables
	------------------------------------------------------------------------- */
	var menu_serialized;
	$('#easymm').nestedSortable({
		listType: 'ul',
		handle: 'div',
		items: 'li',
		placeholder: 'ns-helper',
		opacity: .8,
		handle: '.ns-title',
		toleranceElement: '> div',
		forcePlaceholderSize: true,
		tabSize: 15,
		update: function () {
			menu_serialized = $('#easymm').nestedSortable('serialize');
			$('#btn-save-menu').attr('disabled', false);
		}
	});


	/* edit menu item
	------------------------------------------------------------------------- */
	$('body').on('click', '.edit-menu', function () {
		var menu_id = $(this).next().next().val();
		var menu_div = $(this).parent().parent();
		var li = $(this).closest('li');
		let title = menu_div.find('.ns-title').html();
		let ns_url = menu_div.find('.ns-url').html();
		let ns_icon = menu_div.find('.ns-icon').val();
		$("#ns-title").val(title);
		$("#ns-url").val(ns_url);
		$("#ns-id").val(menu_id);
		$("#ns-icon").val(ns_icon);
		$('#form-edit-menu').submit(function (e) {
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data: $(this).serialize(),
				dataType: 'JSON',
				async: false,
				success: function (data) {
					menu_div.find('.ns-title').html(data.title);
					menu_div.find('.ns-url').html(data.url);
					menu_div.find('.ns-icon').val(data.icon);
				}
			});
		});
	});

	/* delete menu item
	------------------------------------------------------------------------- */
	$('body').on('click', '.delete-menu', function () {
		var li = $(this).closest('li');
		$("#modalID").val($(this).next().val());
		$('#modalDeleteItem').on('click', '.deleteItem', function () {
			var param = {
				id: $("#modalID").val()
			};
			$.ajax({
				type: 'POST',
				url: base_url + 'admin/menu/delete',
				data: param,
				dataType: 'JSON',
				async: false,
				success: function (content) {
					li.remove();
				}
			});
		});
	});

	/* add menu item
	------------------------------------------------------------------------- */
	$('#form-add-menu').submit(function () {
		if ($('#menu-title').val() == '') {
			$('#menu-title').focus();
		} else {
			$.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data: $(this).serialize(),
				error: function () {
					notie.alert({
						type: 'error', // optional, default = 4, enum: [1, 2, 3, 4, 5, 'success', 'warning', 'error', 'info', 'neutral']
						text: '<h2>Success</h2>Save menu has been saved',
						stay: false, // optional, default = false
						time: 1, // optional, default = 3, minimum = 1,
						position: 'top' // optional, default = 'top', enum: ['top', 'bottom']
					});
				},
				success: function (data) {
					switch (data.status) {
						case 1:
							$('#form-add-menu')[0].reset();
							$('#easymm')
								.append(data.li);
							break;
						case 2:
							notie.alert({
								type: 'success', // optional, default = 4, enum: [1, 2, 3, 4, 5, 'success', 'warning', 'error', 'info', 'neutral']
								text: data.msg,
								stay: false, // optional, default = false
								time: 1, // optional, default = 3, minimum = 1,
								position: 'top' // optional, default = 'top', enum: ['top', 'bottom']
							});
							break;
						case 3:
							$('#menu-title').val('').focus();
							break;
					}
				}
			});
		}
		return false;
	});
	$('body').on('change', '.select_category', function () {
		let title = $(this).val();
		let slug  = $(this).find(':selected').data('slug');
		$("input[name=title]").val(title);
		$("input[name=url]").val(slug);
	});
	/* update menu / save order
	------------------------------------------------------------------------- */
	$('#btn-save-menu').attr('disabled', true);
	$('#form-menu').submit(function () {
		$('#btn-save-menu').attr('disabled', true);
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: menu_serialized,
			error: function () {
				$('#btn-save-menu').attr('disabled', false);
				gbox.show({
					content: '<h2>Error</h2>Save menu error. Please try again.',
					autohide: 1000
				});
			},
			success: function (data) {
				notie.alert({
					type: 'success', // optional, default = 4, enum: [1, 2, 3, 4, 5, 'success', 'warning', 'error', 'info', 'neutral']
					text: '<h2>Success</h2>Save menu has been saved',
					stay: false, // optional, default = false
					time: 1, // optional, default = 3, minimum = 1,
					position: 'top' // optional, default = 'top', enum: ['top', 'bottom']
				});
			}
		});
		return false;
	});

	/*add group
	------------------------------------------------------------------------- */
	$('#form-add-group').submit(function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: $(this).serialize(),
			dataType: 'HTML',
			async: false,
			success: function (data) {
				$("#tableContent").html(data);
			}
		});
	});
	/* delete group
	------------------------------------------------------------------------- */
	$('body').on('click', '#action a', function (e) {
		$("#modalID").val($(this).data('id'));
		$('#modalDeleteGroup').on('click', '.deleteItem', function () {
			var param = {
				id: $("#modalID").val()
			};
			$.ajax({
				type: 'POST',
				url: base_url + 'admin/menu/group_delete',
				data: param,
				dataType: 'HTML',
				async: false,
				success: function (data) {
					$("#tableContent").html(data);
				}
			});
		});
	});
	/* edit menu item
	------------------------------------------------------------------------- */
	$('body').on('click', '#action a', function (e) {
		$("#modalID").val($(this).data('id'));
		var tr = $(this).parent().parent().parent();
		let title = tr.find("#title").html();
		$("#modalEditGroup #ns-title").val(title);
		$("#modalEditGroup #ns-id").val($("#modalID").val());
		$('#form-edit-group').submit(function (e) {
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data: $(this).serialize(),
				dataType: 'HTML',
				async: false,
				success: function (data) {
					$("#tableContent").html(data);
				}
			});
		});
	});
});
