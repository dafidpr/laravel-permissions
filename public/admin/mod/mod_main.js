$(document).ready(function () {
	if (typeof dataColumns == "undefined") {
		dataColumns = "";
	}

	if (typeof displayErrors == "undefined") {
		displayErrors = "";
	}

	formSubmit();

	function itemDelete(url) {
		Swal.fire({
			title: "Delete?",
			icon: "question",
			text: "Do you delete item?",
			showConfirmButton: true,
			confirmButtonText: "Yes, delete it",
			confirmButtonClass: "bg-danger",
			showCancelButton: true,
			cancelButtonText: "No",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: base_url + url,
					dataType: "json",
					success: function (data) {
						if (data.status == 400) {
							Swal.fire({
								title: "Failed",
								icon: "error",
								text: data.message,
							});
						} else {
							$("#DataTable").DataTable().ajax.reload();
						}
					},
					error: function (xhr, ajaxOptioins, thrownError) {
						Swal.fire({
							title: xhr.status,
							icon: "warning",
							text: thrownError,
						});
					},
				});
			}
		});
	}

	function formSubmit() {
		$("#formSubmit").submit(function (e) {
			e.preventDefault();
			setError(displayErrors);
			$('button[type="submit"]').addClass("disabled");
			$('button[type="submit"]').html("Loading...");
			$.ajax({
                 headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
				url: $(this).attr("action"),
				method: $(this).attr("method"),
				data: new FormData(this),
				dataType: "json",
				contentType: false,
				processData: false,
				success: function (data) {
					$('button[type="submit"]').removeClass("disabled");
					$('button[type="submit"]').html('<em class="icon ni ni-send"></em><span> Save changes </span>');
					Swal.fire({
						title: "Success",
						icon: "success",
						text: data.messages,
					}).then(function () {
						window.location.href = url + data.redirect;
					});
				},
				error: function (xhr, ajaxOptions, thrownError) {
					console.error(thrownError);
					$('button[type="submit"]').removeClass("disabled");
					$('button[type="submit"]').html('<em class="icon ni ni-send"></em><span> Save changes </span>');
					if(xhr.status == 400){
						displayError(displayErrors, xhr.responseJSON);
					} else if(xhr.status == 409){
						Swal.fire({
							title: 'Error ' + xhr.status,
							icon: "error",
							text: xhr.responseJSON['messages']
						});
					} else {
						Swal.fire({
							title: 'Error ' + xhr.status,
							icon: "error",
							text: 'GET ' + url + '/' + $('#formSubmit').attr('action') + ' ' + thrownError
						});
					}
				},
			});
		});
	}

	function displayError(options, data){
		$.each(options, function(key, value){
			if(data.messages[value.inputName] && data.messages[value.inputName][0]){
				$(value.display).removeClass('d-none');
				$('input[name="'+value.inputName+'"]').addClass('is-invalid');
				$(value.display).html(data.messages[value.inputName][0]);
			}
		});
	}
	function setError(options) {
		$.each(options, function (key, value) {
			$(value.display).addClass("d-none");
			$('input[name="' + value.inputName + '"]').removeClass("is-invalid");
		});
	}

	$.each(displayErrors, function (key, value) {
		$('input[name="' + value.inputName + '"]').keydown(function () {
			$(value.display).addClass("d-none");
			$(this).removeClass("is-invalid");
		});
	});

	checkAll();
	function checkAll()
	{
		$('#uid').click(function(){
			if ( (this).checked == true ){
				$('.uid').prop('checked', true);
			} else {
				$('.uid').prop('checked', false);
			}
		})
	}
});
