$(function () {
	$.validator.addMethod(
		"strongPassword",
		function (value, element) {
			return this.optional(element) || value.length >= 6;
		},
		"Password minimal 6 karakter"
	);

	$.validator.addMethod(
		"max255",
		function (value, element) {
			return this.optional(element) || value.length <= 255;
		},
		"Maksimal 255 karakter"
	);

	$.validator.addMethod(
		"strongNope",
		function (value, element) {
			return this.optional(element) || (value.length >= 10 && value.length <= 13);
		},
		"Nomor HP minimal 10 - 13 Digit Angka"
	);

	$.validator.addMethod(
		"lettersonly",
		function (value, element) {
			return this.optional(element) || /^[a-z ]+$/i.test(value);
		},
		"Letters and spaces only please"
	);
	$("#formInput").validate({
		rules: {
			inputNama: {
				required: true,
				lettersonly: true,
			},
			inputUsername: {
				required: true,
				nowhitespace: true,
				alphanumeric: true,
				remote: {
					url: "/dist/php/checkDataAjax.php",
					type: "post",
					data: {
						username: function () {
							return $("#inputUsername").val();
						},
						tipe: "username",
					},
				},
			},
			inputPassword: {
				required: true,
				alphanumeric: true,
				strongPassword: true,
			},
			inputAlamat: {
				required: true,
				max255: true,
			},
			inputEmail: {
				required: false,
				email: true,
				remote: {
					url: "/dist/php/checkDataAjax.php",
					type: "post",
					data: {
						email: function () {
							return $("#inputEmail").val();
						},
						tipe: "email",
					},
				},
			},
			inputNope: {
				required: true,
				number: true,
				strongNope: true,
				remote: {
					url: "/dist/php/checkDataAjax.php",
					type: "post",
					data: {
						nope: function () {
							return $("#inputNope").val();
						},
						tipe: "nope",
					},
				},
			},
		},
		messages: {
			inputNama: {
				required: "Harap Isi Nama!",
				alphanumeric: "Hanya diperkenankan huruf dan spasi",
			},
			inputUsername: {
				required: "Harap Isi Username!",
				nowhitespace: "Harap tidak menggunakan Spasi",
				alphanumeric: "Hanya diperkenankan huruf, angka, dan underscore",
				remote: 'Username sudah terdaftar, jika sudah terdaftar silahkan <a href="/?page=login">Login</a>!',
			},
			inputPassword: {
				required: "Harap isi Password!",
				alphanumeric: "password hanya boleh Huruf dan Angka!",
			},
			inputAlamat: {
				required: "Harap Isi Alamat!",
			},
			inputEmail: {
				email: "Harap isi E-mail yang Valid!",
				remote: "Email ini sudah terdaftar!",
			},
			inputNope: {
				required: "Harap mengisi Nomer HP",
				number: "Hanya diperkenankan angka saja!",
				remote: "Nomer sudah terdaftar!",
			},
			selectProvinsi: {
				required: "Harap memilih Provinsi anda!",
			},
			selectKota: {
				required: "Harap memilih Kota anda!",
			},
			selectKecamatan: {
				required: "Harap memilih Kecamatan anda!",
			},
		},
		errorPlacement: function (error, element) {
			console.log(element.attr("id"));
			var checkSelect = new RegExp("select");
			if (checkSelect.test(element.attr("id"))) {
				error.insertAfter(element.parent());
			} else {
				error.insertAfter(element);
			}
			// error.insertAfter(element.parent("td"));
			// error.css({ color: "#FFA500", "font-size": "0.750em" });
			// error.addClass("error");
		},
	});
});

$(document).ready(function () {
	var phoneCode = {};
	var phoneNames = {};

	//init data
	getDataPhoneCode();
	getDataProvince();

	// events
	$("#inputNope").keyup(function () {
		let char = $(this).val();
		if (char[0] == 0) {
			$(this).val(char.substring(1));
		}
	});

	$("select#selectProvinsi").on("change", function () {
		populateCities($(this));
	});

	$("select#selectKota").on("change", function () {
		populateDistrict($(this));
	});

	// functions
	function getDataPhoneCode() {
		$.ajax({
			async: false,
			global: false,
			url: "/dist/json/phone.json",
			dataType: "json",
			success: function (data) {
				phoneCode = data;
			},
		});
		$.ajax({
			async: false,
			global: false,
			url: "/dist/json/phoneNames.json",
			dataType: "json",
			success: function (data) {
				phoneNames = data;
			},
		});
		setDataPhoneCode();
	}

	async function setDataPhoneCode() {
		$.each(phoneCode, function (data) {
			$("#selectCodeNegara").append(
				$("<option>")
					.attr("title", "+" + phoneCode[data])
					.attr("value", phoneCode[data])
					.text("+" + phoneCode[data] + " " + phoneNames[data])
			);
		});
		$("#selectCodeNegara").val("62").selectpicker("refresh");
	}

	function getDataProvince() {
		$.ajax({
			url: "/dist/json/provinces.json",
			dataType: "json",
			success: function (data) {
				$.each(data, function (x) {
					$("select#selectProvinsi").append($("<option>").attr("title", data[x].name).attr("value", data[x].name).attr("data-id", data[x].id).text(data[x].name));
				});
				$("select#selectProvinsi").selectpicker("refresh");
			},
		});
	}

	function populateCities(provincesDropdown) {
		const provinceSelected = provincesDropdown.find(":selected").data("id");
		$("select#selectKota").html("");
		$("select#selectKecamatan").html("");
		$("select#selectKecamatan").selectpicker("refresh");
		$.ajax({
			url: "/dist/json/regencies.json",
			dataType: "json",
			success: function (data) {
				$.each(data, function (x) {
					if (data[x].province_id == provinceSelected) {
						$("select#selectKota").append($("<option>").attr("title", data[x].name).attr("value", data[x].name).attr("data-id", data[x].id).text(data[x].name));
					}
				});
				$("select#selectKota").selectpicker("refresh");
			},
		});
	}

	function populateDistrict(cityDropdown) {
		const citySelected = cityDropdown.find(":selected").data("id");
		$("select#selectKecamatan").html("");
		$.ajax({
			url: "/dist/json/districts.json",
			dataType: "json",
			success: function (data) {
				$.each(data, function (x) {
					if (data[x].regency_id == citySelected) {
						$("select#selectKecamatan").append($("<option>").attr("title", data[x].name).attr("value", data[x].name).text(data[x].name));
					}
				});
				$("select#selectKecamatan").selectpicker("refresh");
			},
		});
	}
});
