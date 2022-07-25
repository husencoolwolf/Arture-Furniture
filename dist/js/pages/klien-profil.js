$(document).ready(function () {
  $.validator.addMethod('strongPassword', function (value, element) {
    return this.optional(element) || value.length >= 6;
  }, 'Password minimal 6 karakter');

  $.validator.addMethod('strongNope', function (value, element) {
    return this.optional(element) || (value.length >= 10 && value.length <= 13);
  }, 'Nomor HP minimal 10 - 13 Digit Angka');

  $.validator.addMethod("lettersonly", function (value, element) {
    return this.optional(element) || /^[a-z ]+$/i.test(value);
  }, "Hanya Kapital dan spasi yang diperbolehkan");

  $('#formEditAkun').validate({
    rules: {
      inputNama: {
        required: true,
        lettersonly: true

      },
      inputUsername: {
        required: true,
        nowhitespace: true,
        alphanumeric: true

      },
      inputPasswordLama: {
        required: false,
        remote: {
          url: "/dist/php/checkDataAjax.php",
          type: "post",
          data: {
            password: function () {
              return $("#inputPasswordLama").val();
            },
            // id: GetURLParameter('akun'),
            tipe: "password-profil"
          }
        }
      },
      inputPasswordBaru: {
        required: false,
        alphanumeric: true,
        strongPassword: true,
        remote: {
          url: "/dist/php/checkDataAjax.php",
          type: "post",
          data: {
            password: function () {
              return $("#inputPasswordLama").val();
            },
            // id: GetURLParameter('akun'),
            tipe: "password-profil"
          }
        }
      },
      inputAlamat: {
        required: false
      },
      inputEmail: {
        required: false,
      },
      inputNope: {
        required: false,
        number: true,
        strongNope: true,
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
        remote: 'Username sudah terdaftar, jika sudah terdaftar silahkan ganti username yang lain!'
      },
      inputPasswordLama: {
        remote: 'Password Salah!'
      },
      inputPasswordBaru: {
        required: 'Harap isi Password!',
        alphanumeric: 'password hanya boleh Huruf dan Angka!',
        remote: 'Password Lama Salah!!!'
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
      },
      selectHakAkses: {
        required: 'Harap isi Privilege untuk menentukan hak akses akun ini!'
      }
    }
  });
});

(function () {
  feather.replace()


}())