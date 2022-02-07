//Rubah input ke rupiah
var uang = document.getElementsByClassName("rupiah");
for (var i = 0; i < uang.length; i++) { // loop over them
    uang[i].addEventListener('keyup', function(e){
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            this.value = formatRupiah(this.value, 'Rp. ');
    });
  }


/* Fungsi formatRupiah */
function formatRupiah(angka, prefix){
var number_string = angka.replace(/[^,\d]/g, '').toString(),
split   		= number_string.split(','),
sisa     		= split[0].length % 3,
rupiah     		= split[0].substr(0, sisa),
ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

// tambahkan titik jika yang di input sudah menjadi angka ribuan
if(ribuan){
separator = sisa ? '.' : '';
rupiah += separator + ribuan.join('.');
}

rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
return prefix == undefined ? rupiah : (rupiah ? 'Rp.' + rupiah : '');
}