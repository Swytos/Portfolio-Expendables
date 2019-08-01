var team_members_table;
var team_about_table;
var team_services_table;
var team_projects_table;
var team_feedback_table;

$(document).ready(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	//----------------------Service------------------------//
	$("#apply_service_changes").on('click', function () {
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
	$('.icon').on('change', function () {
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
		scrollX:        true,
		scrollCollapse: true,
		autoWidth:         true,
		paging:         true,
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

	team_projects_table = $('#projects').DataTable({
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
			{ "className": "align-middle", "targets": [4]},
			{ "className": "align-middle", "targets": "_all"}
		]
	});


	$("#project_photo").on('change', function() {
		var url = this.value;
		var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
		if (this.files && this.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
			var reader = new FileReader();

			reader.onload = function (e) {

				$(".upload-profile-photo-wrap").show();
				$(".upload-msg").hide();
				$('#project_img').attr('src', e.target.result);
			}

			reader.readAsDataURL(this.files[0]);
		}else{
			$(".upload-profile-photo-wrap").hide();
			$(".upload-msg").show();
		}
	});

	$("#apply_project_changes").on('click', function () {
		var formData = new FormData($("#project_form")[0]);
		if ($("#project_img").attr('src') != undefined) {
			formData.append('image', $("#project_img").attr('src'));
		};
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
	});


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
});