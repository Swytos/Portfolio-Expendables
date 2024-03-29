var team_members_table;
var team_about_table;
var team_services_table;
var team_projects_table;
var team_feedback_table;
var team_tags_table;
var team_categories_table;
var team_posts_table;

$(document).ready(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	//----------------------Service------------------------//
	$("#apply_service_changes").on('click', function () {
		for (instance in CKEDITOR.instances) {
			CKEDITOR.instances[instance].updateElement();
		}
		var formData = new FormData($("#service_form")[0]);
		$.ajax({
			url: $("#service_form").attr('action'),
			type: 'POST',
			data: formData,
			beforeSend: function() {
				$("#error_block").hide();
				$("#success_block").hide();
			},
			cache: false,
			processData: false,
			contentType: false,
		}).done(function( data ) {
			if (data.success === true) {
				$("#success_block").show();
			}
		}).fail(function(data) {
			$("#error_block").show();
			$("#error_list").html("<ul></ul>");
			$.each(data.responseJSON.errors, function( index, value ) {
				$("#error_list ul").append("<li>"+value+"</li>");
			});
		});

	});
	$('.icon').on('keyup', function () {
		$('.icons').html('');
		var buf = $(this).val();
		$('.icons').append('<i class="fas fa-' + buf + ' fa-2x"></i>');
	});

	$("#services").on('click', '.remove_service', function (event) {

		var tr_row = $(this).parents('tr');
		var service_id = tr_row.attr('service-id');

		$("#remove_service_id").val(service_id);
		$("#remove_service_modal b").text(tr_row.find('th:first').text());
		$("#remove_service_modal").modal('show');
	});

	$("#confirm_removing_service").on('click', function() {
		var service_id = $("#remove_service_id").val();

		$.ajax({
			type: 'POST',
			url: '/admin/removeService',
			data: {
				'service_id': service_id
			},
			success: function(data){
				$("#remove_service_modal").modal('hide');
				if (data.success == true) {
					team_services_table.row( $("tr[service-id='"+service_id+"']") ).remove().draw();
				};
			}
		});
	});

	team_services_table = $('#services').DataTable({
		scrollX: true,
		scrollCollapse: true,
		autoWidth: true,
		paging: true,
		columnDefs: [
			{ "width": "600px", "targets": [1]},
			{ "className": "align-middle", "targets": [1]},
			{ "width": "50px", "targets": [2] },
			{ "className": "text-center", "targets": [2]},
			{ "width": "100px", "targets": [3] },
			{ "className": "text-center", "targets": [3]},
			{ "className": "align-middle", "targets": "_all"}
		]
	});

	//----------------------About--------------------------//

	$("#about").on('click', '.remove_about', function (event) {
		var tr_row = $(this).parents('tr');
		var about_id = tr_row.attr('about-id');
		$("#remove_about_id").val(about_id);
		$("#remove_about_modal b").text(tr_row.find('th:first').text());
		$("#remove_about_modal").modal('show');
	});

	$("#confirm_removing_about").on('click', function() {
		var about_id = $("#remove_about_id").val();
		$.ajax({
			type: 'POST',
			url: '/admin/removeAbout',
			data: {
				'about_id': about_id
			},
			success: function(data){
				console.log(data);
				$("#remove_about_modal").modal('hide');
				if (data.success == true) {
					team_about_table.row( $("tr[about-id='"+about_id+"']") ).remove().draw();
				};
			}
		});
	});

	$("#about_photo").on('change', function() {
		var url = this.value;
		var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
		if (this.files && this.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
			var reader = new FileReader();

			reader.onload = function (e) {

				$(".upload-profile-photo-wrap").show();
				$(".upload-msg").hide();
				$('#about_img').attr('src', e.target.result);
			}

			reader.readAsDataURL(this.files[0]);
		}else{
			$(".upload-profile-photo-wrap").hide();
			$(".upload-msg").show();
		}
	});

	$("#apply_about_changes").on('click', function () {
		for (instance in CKEDITOR.instances) {
			CKEDITOR.instances[instance].updateElement();
		}
		var formData = new FormData($("#about_form")[0]);
		var photo_obj = $('#about_img');
		photo_obj.croppie('result', {
			type: 'canvas',
			size: 'upload'
		}).then(function (resp) {
			if (photo_obj.parents('.photo-wrap.upload-photo.ready').length !== 0){
				formData.append('photo', resp);
			};

			$.ajax({
				url: $("#about_form").attr('action'),
				type: 'POST',
				data: formData,
				beforeSend: function() {
					$("#error_block").hide();
					$("#success_block").hide();
				},
				cache: false,
				processData: false,
				contentType: false,
			}).done(function( data ) {
				if (data.success === true) {
					$("#success_block").show();
				}
			}).fail(function(data) {
				$("#error_block").show();
				$("#error_list").html("<ul></ul>");
				$.each(data.responseJSON.errors, function( index, value ) {
					$("#error_list ul").append("<li>"+value+"</li>");
				});
			});
		});
	});

	team_about_table = $('#about').DataTable({
		scrollX:        true,
		scrollCollapse: true,
		autoWidth:         true,
		paging:         true,
		columnDefs: [
			{ "width": "600px", "targets": [2] },
			{ "className": "align-middle", "targets": [2]},
			{ "width": "50px", "targets": [3] },
			{ "className": "text-center", "targets": [3]},
			{ "width": "100px", "targets": [4] },
			{ "className": "text-center", "targets": [4]},
			{ "className": "align-middle", "targets": "_all"}
		]
	});

	//----------------------Member-------------------------//

	team_members_table = $('#team_members').DataTable({
		scrollX:        true,
		scrollCollapse: true,
		autoWidth:         true,
		paging:         true,
		columnDefs: [
			{ "width": "600px", "targets": [2] },
			{ "className": "align-middle", "targets": [2]},
			{ "width": "50px", "targets": [3] },
			{ "className": "text-center", "targets": [3]},
			{ "width": "100px", "targets": [4] },
			{ "className": "text-center", "targets": [4]},
			{ "className": "align-middle", "targets": "_all"}
		]
	});

	$("#team_members").on('click', '.remove_member', function (event) {
		var tr_row = $(this).parents('tr');
		var member_id = tr_row.attr('member-id');
		$("#remove_member_id").val(member_id);
		$("#remove_member_modal b").text(tr_row.find('th:first').text());
		$("#remove_member_modal").modal('show');
	});

	$("#confirm_removing_member").on('click', function() {
		var member_id = $("#remove_member_id").val();
		$.ajax({
			type: 'POST',
			url: '/admin/removeMember',
			data: {
				'member_id': member_id
			},
			success: function(data){
				$("#remove_member_modal").modal('hide');
				if (data.success == true) {
					team_members_table.row( $("tr[member-id='"+member_id+"']") ).remove().draw();
				};
			}
		});
	});

	$("#apply_member_changes").on('click', function () {
		for (instance in CKEDITOR.instances) {
			CKEDITOR.instances[instance].updateElement();
		}
		var formData = new FormData($("#profile_form")[0]);
		var photo_obj = $('#upload-photo');
		photo_obj.croppie('result', {
			type: 'canvas',
			size: 'upload'
		}).then(function (resp) {
			if (photo_obj.parents('.photo-wrap.upload-photo.ready').length !== 0){
				formData.append('photo', resp);
			};
			$.ajax({
				url: $("#profile_form").attr('action'),
				type: 'POST',
				data: formData,
				beforeSend: function() {
					$("#error_block").hide();
					$("#success_block").hide();
				},
				cache: false,
				processData: false,
				contentType: false,
			}).done(function( data ) {
				if (data.success === true) {
					$("#success_block").show();
				}
			}).fail(function(data) {
				$("#error_block").show();
				$("#error_list").html("<ul></ul>");
				$.each(data.responseJSON.errors, function( index, value ) {
					$("#error_list ul").append("<li>"+value+"</li>");
				});
			});
		});
	});

	$("#change_member_photo, #change_project_photo").on('click', function() {
		$("#project").hide();
		$("#team-member").hide();
		$("#uploading_image").show();
	});

	//----------------------Project------------------------//

	var count = 0;

	if (typeof files !== 'undefined') {
		files['new'] = {};

	$.each(files['old'], function(index,value) {
		displayOldImage(index,value);
	});
	function displayOldImage(fileId,file) {
		if (count == 0){
			$(".upload-profile-photo-wrap").show();
				$(".upload-msg").hide();
				$('.upload-profile-photo-wrap').append(
					'<div class="main col-12 text-center">'+
					'<a data-fancybox="image" href="'+ file +'"><img src="'+ file +'"/></a>' +
					'<div class="delete" data-type="old" data-file-id="'+ fileId +'" ><i class="fas fa-times fa-2x" aria-hidden="true"></i></div>'+
					'</div>');
			count++;
		} else if(count > 0){
			$('.upload-profile-photo-wrap').after(
				'<div class="minor col-4">'+
				'<a data-fancybox="image" href="'+ file +'"><img src="'+ file +'" alt=""></a>'+
				'<div class="delete" data-type="old" data-file-id="'+ fileId +'"><i class="fas fa-times fa-1x" aria-hidden="true"></i></div>'+
				'</div>'
			);
		}
	}
	team_projects_table = $('#projects').DataTable({
		scrollX:        true,
		scrollCollapse: true,
		autoWidth:         true,
		paging:         true,
		columnDefs: [
			{ "width": "600px", "targets": [2] },
			{ "className": "align-middle", "targets": [2]},
			{ "width": "300px", "targets": [3] },
			{ "className": "text-center", "targets": [3]},
			{ "width": "100px", "targets": [4] },
			{ "className": "align-middle", "targets": [4]},
			{ "className": "align-middle", "targets": "_all"}
		]
	});

	$("#project_photo").on('change', function() {
		$.each(this.files, function(index, file) {
			var fileId = hashCode();
			files['new'][fileId] = file;
			displayNewImage(fileId, file);
		});
	});

	$('body').on('click','.delete', function() {
		var type = $(this).attr('data-type');
		var imageId = $(this).attr('data-file-id');
		if (type == 'old'){
			delete files['old'][imageId];
		} else if (type == 'new') {
			delete files['new'][imageId];
		}
		$('.upload-profile-photo-wrap').html('');
		$('.minor').remove();
		count = 0;
		if ($.isEmptyObject(files['old']) == false || $.isEmptyObject(files['new']) == false){
			$.each(files['new'], function(index, file){
				displayNewImage(index, file);
			});
			$.each(files['old'], function(index, file){
				displayOldImage(index, file);
			});
		} else {
			$(".upload-msg").show();
		}
	});
	window.hashCode = function() {
		return  Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
	};

	function displayNewImage(fileId,file) {
		if (count == 0){
			var reader = new FileReader();
			reader.onload = function (e) {
				$(".upload-profile-photo-wrap").show();
				$(".upload-msg").hide();
				$('.upload-profile-photo-wrap').append(
					'<div class="main col-12 text-center">'+
					'<a data-fancybox="image" href="'+ e.target.result +'"><img src="'+ e.target.result +'"/></a>' +
					'<div class="delete" data-type="new" data-file-id="'+ fileId +'" ><i class="fas fa-times fa-2x" aria-hidden="true"></i></div>'+
					'</div>');
			}
			reader.readAsDataURL(file);
			count++;
		} else if(count > 0){
			var reader = new FileReader();
			reader.onload = function (e) {
				$('.upload-profile-photo-wrap').after(
					'<div class="minor col-4">'+
					'<a data-fancybox="image" href="'+ e.target.result +'"><img src="'+ e.target.result +'" alt=""></a>'+
					'<div class="delete" data-type="new" data-file-id="'+ fileId +'"><i class="fas fa-times fa-1x" aria-hidden="true"></i></div>'+
					'</div>'
				);
			}
			reader.readAsDataURL(file);
		}
	}

	$("#apply_project_changes").on('click', function () {
		if((Object.keys(files['old']).length + Object.keys(files['new']).length) <= 4){
			for (instance in CKEDITOR.instances) {
				CKEDITOR.instances[instance].updateElement();
			}
			var formData = new FormData($("#project_form")[0]);
			var arrayOld = $.map(files['old'], function(value, index) {
				return [value];
			});
			$.each(arrayOld, function(index, file){
				formData.append("fileOld[]", file);
			});
			var arrayNew = $.map(files['new'], function(value, index) {
				return [value];
			});
			$.each(arrayNew, function(index, file){
				formData.append("fileNew[]", file);
			});
			if($('#display_project').prop("checked") == true){
				formData.append("display_project", 1);
			}
			else if($('#display_project').prop("checked") == false){
				formData.append("display_project", 0);
			}
			$.ajax({
				url: $("#project_form").attr('action'),
				type: 'POST',
				data: formData,
				beforeSend: function() {
					$("#error_block").hide();
					$("#success_block").hide();
				},
				cache: false,
				processData: false,
				contentType: false,
			}).done(function( data ) {
				if (data.success === true) {
					$("#success_block").show();
				}
			}).fail(function(data) {
				$("#error_block").show();
				$("#error_list").html("<ul></ul>");
				$.each(data.responseJSON.errors, function( index, value ) {
					$("#error_list ul").append("<li>"+value+"</li>");
				});
			});
		} else {
			$("#error_block").show();
			$("#error_list").html("<ul></ul>");
			$("#error_list ul").append("<li>The file may not be greater than 4 characters.</li>");
		}

	});

	$("body").on('click', '.remove_project', function (event) {
        // event.preventDefault();
        console.log(1234);
		var tr_row = $(this).parents('tr');
		var project_id = tr_row.attr('project-id');
		$("#remove_project_id").attr('value', project_id);
		$("#remove_project_modal b").text(tr_row.find('th:first').text());
		$("#remove_project_modal").modal('show');
	});

	$("#confirm_removing_project").on('click', function() {
		var project_id = $("#remove_project_id").val();
		$.ajax({
			type: 'POST',
			url: '/admin/remove_project',
			data: {
				'project_id': project_id
			},
			success: function(data){
				$("#remove_project_modal").modal('hide');
				if (data.success == true) {
					team_projects_table.row( $("tr[project-id='"+project_id+"']") ).remove().draw();
				};
			}
		});
	});
	}
	//----------------------Feedback-----------------------//

	team_feedback_table = $('#feedback').DataTable({
		scrollX:        true,
		scrollCollapse: true,
		autoWidth:         true,
		paging:         true,
		columnDefs: [

			{ "width": "600px", "targets": [4] },
			{ "className": "align-middle", "targets": [4]},
			{ "width": "100px", "targets": [5] },
			{ "className": "text-center", "targets": [5]},
			{ "className": "align-middle", "targets": "_all"}
		]
	});

	$("#feedback").on('click', '.remove_feedback', function (event) {
		var tr_row = $(this).parents('tr');
		var feedback_id = tr_row.attr('feedback-id');
		$("#remove_feedback_id").attr('value', feedback_id);
		$("#remove_feedback_modal b").text(tr_row.find('th:first').text());
		$("#remove_feedback_modal").modal('show');
	});

	$("body").on('click', '.reply_feedback', function (event) {
		$('#success, #error').hide();
		$("#reply_feedback_modal").modal('show');
	});

	$("#confirm_removing_feedback").on('click', function() {
		var feedback_id = $("#remove_feedback_id").val();
		$.ajax({
			type: 'POST',
			url: '/admin/removeFeedback',
			data: {
				'feedback_id': feedback_id
			},
			success: function(data){
				$("#remove_feedback_modal").modal('hide');
				if (data.success == true) {
					team_feedback_table.row( $("tr[feedback-id='"+feedback_id+"']") ).remove().draw();
				};
			}
		});
	});

	$('body').on('click', '#confirm_reply_feedback', function (event) {
		event.preventDefault();
		$("#reply_feedback_modal").modal('hide');
		for (instance in CKEDITOR.instances) {
			CKEDITOR.instances[instance].updateElement();
		}
		var data = new FormData($("#formReply")[0]);
		$.ajax({
			type: 'POST',
			url: $("#formReply").attr("action"),
			data: data,
			cache: false,
			processData: false,
			contentType: false,
		}).done(function (response) {
			$('#success, #error').html('');
			if(response.success == true){
				$('#success').show();
				$('#success').append('<h4><i class="fas fa-envelope"></i> Message sent</h4>');
			} else {
				$('#error').show();
				$('#error').append('<h4><i class="fa fa-bug" aria-hidden="true"></i> You must enter message</h4>');
			}
		});
	});

	//----------------------Blog-----------------------//

	//----------------------Tags-----------------------//

	$('.nav-link').on('click', function() {
		if($(this).attr('aria-expanded') == 'false'){
			$(this).find('#arrow').removeClass('fa-angle-down').addClass('fa-angle-up');
			$(this).parent('li').addClass('active');
		} else {
			$(this).find('#arrow').removeClass('fa-angle-up').addClass('fa-angle-down');
			$(this).parent('li').removeClass('active');
		}
	});

	if(nav_bar == 'Tags' || nav_bar == 'Categories' || nav_bar == 'Posts'){
		$(document).find('#collapse-blog').addClass('show');
		$(document).find('#arrow').parents('li').addClass('active');
	}

	team_tags_table = $('#tags').DataTable({
		scrollX:        true,
		scrollCollapse: true,
		autoWidth:         true,
		paging:         true,
		columnDefs: [
			{ "width": "100px", "targets": [1] },
			{ "className": "text-center", "targets": [1]},
			{ "className": "align-middle", "targets": "_all"}
		]
	});

	$("#apply_tag_changes").on('click', function () {
		var formData = new FormData($("#tag_form")[0]);
		$.ajax({
			url: $("#tag_form").attr('action'),
			type: 'POST',
			data: formData,
			beforeSend: function() {
				$("#error_block").hide();
				$("#success_block").hide();
			},
			cache: false,
			processData: false,
			contentType: false,
		}).done(function( data ) {
			if (data.success === true) {
				$("#success_block").show();
			}
		}).fail(function(data) {
			$("#error_block").show();
			$("#error_list").html("<ul></ul>");
			$.each(data.responseJSON.errors, function( index, value ) {
				$("#error_list ul").append("<li>"+value+"</li>");
			});
		});
	});

	$("#tags").on('click', '.remove_tag', function (event) {
		var tr_row = $(this).parents('tr');
		var tag_id = tr_row.attr('tag-id');
		$("#remove_tag_id").attr('value', tag_id);
		$("#remove_tag_modal b").text(tr_row.find('th:first').text());
		$("#remove_tag_modal").modal('show');
	});

	$("#confirm_removing_tag").on('click', function() {
		var tag_id = $("#remove_tag_id").val();
		$.ajax({
			type: 'POST',
			url: '/admin/removeTag',
			data: {
				'tag_id': tag_id
			},
			success: function(data){
				$("#remove_tag_modal").modal('hide');
				if (data.success == true) {
					team_tags_table.row( $("tr[tag-id='"+tag_id+"']") ).remove().draw();
				};
			}
		});
	});

	//----------------------Categories-----------------------//

	team_categories_table = $('#categories').DataTable({
		scrollX:        true,
		scrollCollapse: true,
		autoWidth:         true,
		paging:         true,
		columnDefs: [
			{ "width": "100px", "targets": [1] },
			{ "className": "text-center", "targets": [1]},
			{ "className": "align-middle", "targets": "_all"}
		]
	});

	$("#apply_category_changes").on('click', function () {
		var formData = new FormData($("#category_form")[0]);
		$.ajax({
			url: $("#category_form").attr('action'),
			type: 'POST',
			data: formData,
			beforeSend: function() {
				$("#error_block").hide();
				$("#success_block").hide();
			},
			cache: false,
			processData: false,
			contentType: false,
		}).done(function( data ) {
			if (data.success === true) {
				$("#success_block").show();
			}
		}).fail(function(data) {
			$("#error_block").show();
			$("#error_list").html("<ul></ul>");
			$.each(data.responseJSON.errors, function( index, value ) {
				$("#error_list ul").append("<li>"+value+"</li>");
			});
		});
	});

	$("#categories").on('click', '.remove_category', function (event) {
		var tr_row = $(this).parents('tr');
		var category_id = tr_row.attr('category-id');
		$("#remove_category_id").attr('value', category_id);
		$("#remove_category_modal b").text(tr_row.find('th:first').text());
		$("#remove_category_modal").modal('show');
	});

	$("#confirm_removing_category").on('click', function() {
		var category_id = $("#remove_category_id").val();
		$.ajax({
			type: 'POST',
			url: '/admin/removeCategory',
			data: {
				'category_id': category_id
			},
			success: function(data){
				$("#remove_category_modal").modal('hide');
				if (data.success == true) {
					team_categories_table.row( $("tr[category-id='"+category_id+"']") ).remove().draw();
				};
			}
		});
	});

	//----------------------Posts-----------------------//

	team_posts_table = $('#posts').DataTable({
		scrollX: true,
		scrollCollapse: true,
		autoWidth: true,
		paging: true,
		columnDefs: [
			{ "width": "600px", "targets": [1] },
			{ "className": "text-left", "targets": [1]},
			{ "width": "100px", "targets": [4] },
			{ "className": "text-center", "targets": [4]},
			{ "className": "align-middle", "targets": "_all"}
		]
	});

	$("#apply_post_changes").on('click', function () {
		for (instance in CKEDITOR.instances) {
			CKEDITOR.instances[instance].updateElement();
		}
		var formData = new FormData($("#post_form")[0]);
		$.ajax({
			url: $("#post_form").attr('action'),
			type: 'POST',
			data: formData,
			beforeSend: function() {
				$("#error_block").hide();
				$("#success_block").hide();
			},
			cache: false,
			processData: false,
			contentType: false,
		}).done(function( data ) {
			if (data.success === true) {
				$("#success_block").show();
			}
		}).fail(function(data) {
			$("#error_block").show();
			$("#error_list").html("<ul></ul>");
			$.each(data.responseJSON.errors, function( index, value ) {
				$("#error_list ul").append("<li>"+value+"</li>");
			});
		});
	});

	$("#posts").on('click', '.remove_post', function (event) {
		var tr_row = $(this).parents('tr');
		var post_id = tr_row.attr('post-id');
		$("#remove_post_id").attr('value', post_id);
		$("#remove_post_modal b").text(tr_row.find('th:first').text());
		$("#remove_post_modal").modal('show');
	});

	$("#confirm_removing_post").on('click', function() {
		var post_id = $("#remove_post_id").val();
		console.log(post_id);
		$.ajax({
			type: 'POST',
			url: '/admin/removePost',
			data: {
				'post_id': post_id
			},
			success: function(data){
				$("#remove_post_modal").modal('hide');
				if (data.success == true) {
					team_posts_table.row( $("tr[post-id='"+post_id+"']") ).remove().draw();
				};
			}
		});
	});


});