$(document).ready(function () {
  var originGambar = $('#previewImage').attr('src');
  $('#addKategoriBtn').click(function () {

  });

  $('#formAddKategori').validate({

    rules: {
      inputKategori: {
        required: true
      }
    },

    submitHandler: function (form) {
      $.ajax({
        url: form.action,
        type: form.method,
        data: $(form).serialize(),
        success: function (response) {
          $('.toast > .toast-body').html(response);
          $('#modalAddKategori').modal('toggle');
          $('.toast').toast('show');
          updateKategori();
        }
      });
    }
  });

  inputGambar.onchange = evt => {
    const [file] = inputGambar.files
    console.log(file)
    if (file) {
      previewImage.src = URL.createObjectURL(file)
      fullImage.href = URL.createObjectURL(file)
      // uploadLogo.style.display = 'none'
      previewImage.style.display = 'inline-block'
    }else{
      previewImage.src = originGambar
      fullImage.href = originGambar
      // uploadLogo.style.display = 'inline-block'
      // previewImage.style.display = 'none'
    }
  }

  function updateKategori() {
    $.getJSON("/app/proses.php?request=updateKategori", function (data) {
      //      console.log("data");
      $("#selectKategori").html('<option value="">--Pilih Kategori--</option>');
      $.each(data, function (key, value) {
        $("#selectKategori").append('<option value="' + key + '">' + value + '</option>');
      });
    });
  }
});

(function () {
  feather.replace()


}())