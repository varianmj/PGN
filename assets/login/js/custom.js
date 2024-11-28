// http: / / localhost / hmif / admin / periode
// http: / / localhost / hmif / staff / periode
//  0     1      2        3       4         5

var url = window.location.href.split("/");
var base_url =
	window.location.protocol +
	"//" +
	window.location.hostname +
	"/" +
	url[3] +
	"/" +
	url[4] +
	"/";

function notif(pesan) {
	Swal.fire({
		icon: pesan.toLowerCase().includes("berhasil") ? "success" : "error",
		title: "Informasi",
		text: pesan,
		confirmButtonColor: "#006843",
		timer: 2000,
	});
}

$(".pop-up").on("click", function () {
	var action = $(this).data("action");
	var table = $(this).data("table");
	var form = $(this).data("form");

	$(".modal-title").html(
		action.charAt(0).toUpperCase() + action.slice(1) + " Data"
	);

	$("#" + form + " .invalid-feedback").html("");
	$("#" + form + " .column").removeClass("is-invalid");
	$(
		"#" + form + " input, #" + form + " select, #" + form + " textarea"
	).removeClass("valid error");
	if (form == "formFile") {
		if (action == "ubah") {
			$("#" + form + " input[name=" + table + "_id]").remove();
			$("#" + form).prepend("<input type='hidden' name='" + table + "_id'>");

			$("#" + form + " .action").removeClass("tambahFile");
			$("#" + form + " .action").addClass("ubahFile");
		} else {
			$("#" + form + " input[name=" + table + "_id]").remove();

			$("#" + form + " .action").removeClass("ubahFile");
			$("#" + form + " .action").addClass("tambahFile");

			$("#" + form).trigger("reset");
		}
	} else {
		if (action == "ubah") {
			$("#" + form + " input[name=" + table + "_id]").remove();
			$("#" + form).prepend("<input type='hidden' name='" + table + "_id'>");

			$("#" + form + " .action").removeClass("tambah");
			$("#" + form + " .action").addClass("ubah");
		} else {
			$("#" + form + " input[name=" + table + "_id]").remove();

			$("#" + form + " .action").removeClass("ubah");
			$("#" + form + " .action").addClass("tambah");

			$("#" + form).trigger("reset");
		}
	}
});

function validation(form, dataValidasi) {
	var name = [];

	$("#" + form + " input, #" + form + " select, #" + form + " textarea").each(
		function () {
			nameForm = $(this).attr("name");
			if (!name.includes(nameForm)) {
				name.push(nameForm);
			}
		}
	);

	name.forEach(function (nameTag) {
		if (dataValidasi[nameTag]) {
			$("#" + form + " [name='" + nameTag + "']").addClass("is-invalid");
			$("#" + form + " [name='" + nameTag + "']").removeClass("is-valid");

			$("#" + form + " [name='" + nameTag + "']")
				.parents(".column")
				.children(".invalid-feedback")
				.html(dataValidasi[nameTag]);
		} else {
			$("#" + form + " [name='" + nameTag + "']").removeClass("is-invalid");
			$("#" + form + " [name='" + nameTag + "']").addClass("is-valid");

			$("#" + form + " [name='" + nameTag + "']")
				.parents(".column")
				.children(".invalid-feedback")
				.html("");
		}
	});
}

function formulir(controller, method, form = "form") {
	$.ajax({
		type: "POST",
		enctype: "multipart/form-data",
		url: base_url + controller + "/" + method,
		data: new FormData($("#" + form)[0]),
		processData: false,
		contentType: false,
		cache: false,
		dataType: "json",
		success: function (result) {
			if (result.status == "success") {
				location.reload();
			} else {
				validation(form, result.validation);
			}
		},
	});
}
