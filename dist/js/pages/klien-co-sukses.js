$(function () {
  $.validator.addMethod("letterandspace", function (value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
  }, "Hanya Huruf diperbolehkan!");

  $('#formBayar').validate({

    rules: {
      inputNorek: {
        required: true,
        number: true,
      },
      selectBank: {
        required: true,
      },
      inputNasabah: {
        required: true,
        letterandspace: true
      }
    },

    submitHandler: function (form) {
      console.log(test);
      $.ajax({
        url: form.action,
        type: form.method,
        data: $(form).serialize(),
        success: function (response) {
          if (response == true) {
            // window.location.href = window.location.href;
          } else {
            $('.toast-body').html("<div class='alert alert-danger'>" + response + "</div");
            $('.toast').toast('show');
          }
        }
      });
    }
  });
});

$(document).ready(function () {
  // new ClipboardJS('#salinKode');



  $('#salinKode').click(function () {
    copyToClipboard($("#targetSalin").html());
    alert('kode pesanan disalin');
  });
});