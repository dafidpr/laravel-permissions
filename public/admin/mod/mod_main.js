$(document).ready(function () {
	if (typeof dataColumns == "undefined") {
		dataColumns = "";
	}

	if (typeof displayErrors == "undefined") {
		displayErrors = "";
	}

	if (typeof dtDrawCallback == "undefined") {
		dtDrawCallback = null;
	}

	if (typeof dtDrawCallback == "undefined") {
		dtDrawCallback = () => {};
	}

	loadData(dataColumns, dtDrawCallback);

	if (typeof dataTableOptions == "undefined") {
		var dataTableOptions = null;
	}

	function loadData(columns = [], drawCallback) {
		// var datatableUrl = $("#DataTable").data("url");

		// $("#DataTable").DataTable({
		// 	processing: true,
		// 	serverSide: true,
		// 	ajax: {
		// 		url: datatableUrl,
		// 		type: "POST",
		// 		dataType: "json",
		// 	},
		// 	columns: columns,
		// 	responsive: true,
		// 	dataTableOptions,
		// 	drawCallback,
		// });

		// loadDataTablesInit();
		// loadDataTablesResponsive();
		formSubmit();
	}

	// function loadDataTablesInit() {
	// 	$("#DataTable").on("draw.dt", function () {
	// 		$(".action").click(function () {
	// 			var toggle = $(this).data("toggle");
	// 			var dataUrl = $(this).data("url");

	// 			if (toggle == "edit") {
	// 				window.location.assign(base_url + dataUrl);
	// 			}
	// 			if (toggle == "delete") {
	// 				itemDelete(dataUrl);
	// 			}
	// 		});
	// 	});
	// }

	// function loadDataTablesResponsive(){
	// 	$("#DataTable").DataTable().on("responsive-display", function () {
	// 		$(".action").click(function () {
	// 			var toggle = $(this).data("toggle");
	// 			var dataUrl = $(this).data("url");

	// 			if (toggle == "edit") {
	// 				window.location.assign(base_url + dataUrl);
	// 			}
	// 			if (toggle == "delete") {
	// 				itemDelete(dataUrl);
	// 			}
	// 		});
	// 	});
	// }

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
			var dataRedirect = $(this).data("redirect");
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
					$('button[type="submit"]').html('<i class="fe fe-send"></i> Submit');
					if (data.status == 400 || data.status == 500) {
						if (data.status == 400) {
							displayError(displayErrors, data);
						} else {
							Swal.fire({
								title: "Failed",
								icon: "error",
								text: data.message,
							});
						}
					} else {
						Swal
							.fire({
								title: "Success",
								icon: "success",
								text: data.message,
							})
							.then(function () {
								if (dataRedirect != null || dataRedirect != undefined) {
									window.location.assign(base_url + dataRedirect);
									loadData();
								} else {
									$("#DataTable").DataTable().ajax.reload();
									$("#" + $(".modal").attr("id")).modal("hide");
								}

								if(typeof loadDataBills != 'undefined'){
									loadDataBills();
								}
							});
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					console.error(thrownError);
					$('button[type="submit"]').removeClass("disabled");
					$('button[type="submit"]').html('<i class="fe fe-send"></i> Submit');
					Swal.fire({
						title: xhr.status,
						icon: "warning",
						text: thrownError,
					});
				},
			});
		});
	}

	function displayError(options, data) {
		$.each(options, function (key, value) {
			if (data[value.inputName]) {
				$(value.display).removeClass("d-none");
				$(value.display).html(data[value.inputName]);
				$('input[name="' + value.inputName + '"]').addClass("is-invalid");
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

	$("#logout").click(function (e) {
		e.preventDefault();
		Swal
			.fire({
				title: "Logout?",
				icon: "warning",
				text: "Are you sure to logout?",
				showConfirmButton: true,
				confirmButtonText: "Yes, sure",
				showCancelButton: true,
				cancelButtonText: "No",
			})
			.then((result) => {
				if (result.isConfirmed) {
					var url = $(this).attr("href");
					window.location.assign(url);
				}
			});
	});
});
