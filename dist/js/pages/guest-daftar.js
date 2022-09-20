$(function () {

  $.validator.addMethod('strongPassword', function (value, element) {
    return this.optional(element) || value.length >= 6;
  }, 'Password minimal 6 karakter');

  $.validator.addMethod('strongNope', function (value, element) {
    return this.optional(element) || (value.length >= 10 && value.length <= 13);
  }, 'Nomor HP minimal 10 - 13 Digit Angka');

  $.validator.addMethod("lettersonly", function (value, element) {
    return this.optional(element) || /^[a-z ]+$/i.test(value);
  }, "Letters and spaces only please");
  $('#formInput').validate({
    rules: {
      inputNama: {
        required: true,
        lettersonly: true

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
            tipe: "username"
          }
        }
      },
      inputPassword: {
        required: true,
        alphanumeric: true,
        strongPassword: true
      },
      inputAlamat: {
        required: true
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
            tipe: "email"
          }
        }
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
            tipe: "nope"
          }
        }
      }
    },
    messages: {
      inputNama: {
        required: 'Harap Isi Nama!',
        alphanumeric: 'Hanya diperkenankan huruf dan spasi'
      },
      inputUsername: {
        required: 'Harap Isi Username!',
        nowhitespace: 'Harap tidak menggunakan Spasi',
        alphanumeric: 'Hanya diperkenankan huruf, angka, dan underscore',
        remote: 'Username sudah terdaftar, jika sudah terdaftar silahkan <a href="/?page=login">Login</a>!'
      },
      inputPassword: {
        required: 'Harap isi Password!',
        alphanumeric: 'password hanya boleh Huruf dan Angka!'
      },
      inputAlamat: {
        required: 'Harap Isi Alamat!'
      },
      inputEmail: {
        email: 'Harap isi E-mail yang Valid!',
        remote: 'Email ini sudah terdaftar!'
      },
      inputNope: {
        required: 'Harap mengisi Nomer HP',
        number: 'Hanya diperkenankan angka saja!',
        remote: 'Nomer sudah terdaftar!'
      }
    }
  });
});

$(document).ready(function () {
  var phoneCode = {};
  var phoneNames = {};

  //init data
  getDataPhoneCode();

  $('#inputNope').keyup(function () {
    let char = $(this).val();
    if (char[0] == 0) {
      $(this).val(char.substring(1));
    }
  });

  function getDataPhoneCode() {
    $.ajax({
      'async': false,
      'global': false,
      'url': "/dist/json/phone.json",
      'dataType': "json",
      'success': function (data) {
        phoneCode = data;
      }
    });
    $.ajax({
      'async': false,
      'global': false,
      'url': "/dist/json/phoneNames.json",
      'dataType': "json",
      'success': function (data) {
        phoneNames = data;
      }
    });
    setDataPhoneCode();
  }

  async function setDataPhoneCode() {
    $.each(phoneCode, function (data) {
      $('#selectCodeNegara').append($("<option>")
        .attr("title", "+" + phoneCode[data])
        .attr("value", phoneCode[data])
        .text("+" + phoneCode[data] + " " + phoneNames[data])
      )
    });
    $('#selectCodeNegara').val('62').selectpicker('refresh');
  }
});