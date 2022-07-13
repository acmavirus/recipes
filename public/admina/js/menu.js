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
					gbox.show({
						content: 'Add menu item error. Please try again.',
						autohide: 1000
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
							gbox.show({
								content: data.msg,
								autohide: 1000
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
				gbox.show({
					content: '<h2>Success</h2>Save menu has been saved',
					autohide: 1000
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
