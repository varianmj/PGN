// http: / / localhost / hmif / admin / periode
// http: / / localhost / hmif / staff / periode
//  0     1      2        3       4         5

$(".loader").delay(200).fadeOut("slow");
$("#overlayer").delay(200).fadeOut("slow");

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

$("#datatables").DataTable({
	pagingType: "full_numbers",
	lengthMenu: [
		[10, 25, 50, -1],
		[10, 25, 50, "All"],
	],
	responsive: true,
	language: {
		lengthMenu: "Menampilkan _MENU_ Data",
		search: "_INPUT_",
		searchPlaceholder: "Cari Data",
		emptyTable: "Data tidak tersedia",
		info: "Menampilkan <b> _START_ - _END_ </b> dari <b> _TOTAL_ </b> data",
		infoEmpty: "Menampilkan <b> 0 - 0 </b> dari <b> 0 </b> data",
		infoFiltered: "| Menyaring dari _MAX_ total data)",
		zeroRecords: "Data tidak ditemukan",
		paginate: {
			first: "<i class='bi bi-skip-start-fill'></i>",
			next: "<i class='bi bi-skip-forward-fill'></i>",
			previous: "<i class='bi bi-skip-backward-fill'></i>",
			last: "<i class='bi bi-skip-end-fill'></i>",
		},
	},
});

function formatRupiah(angka) {
	var number_string = angka.replace(/[^,\d]/g, "").toString();
	var split = number_string.split(",");
	var sisa = split[0].length % 3;
	var rupiah = split[0].substr(0, sisa);
	var ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	if (ribuan) {
		separator = sisa ? "." : "";
		rupiah += separator + ribuan.join(".");
	}

	rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
	return rupiah ? "Rp. " + rupiah : "";
}

$(document).on("click", ".pop-up", function () {
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

$(document).on("click", ".btn-hapus", function (e) {
	e.preventDefault();

	var href = $(this).attr("href");
	Swal.fire({
		title: "Apakah Anda Yakin?",
		text: "Data akan dihapus",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#006843",
		confirmButtonText: "Ya",
		cancelButtonText: "Tidak",
	}).then((result) => {
		if (result.isConfirmed) {
			document.location.href = href;
		}
	});
});

$(".btn-show-hide").on("click", function (e) {
	e.preventDefault();

	var href = $(this).attr("href");
	Swal.fire({
		title: "Apakah Anda Yakin?",
		text: "Data akan diubah",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#006843",
		confirmButtonText: "Ya",
		cancelButtonText: "Tidak",
	}).then((result) => {
		if (result.isConfirmed) {
			document.location.href = href;
		}
	});
});
