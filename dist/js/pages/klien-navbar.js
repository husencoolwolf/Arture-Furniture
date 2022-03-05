$(document).ready(function () {
  updateKeranjang(); //inisiasi jumlah keranjang

  function updateKeranjang(){
    $.ajax({  
      type: "GET",
      url: "/app/proses.php?request=update-keranjang",             
      dataType: "html",                
      success: function(response){                    
          $("#jmlKeranjang").html(response); 
      }
    });
  }
});


$("a").on('click', function(event) {
  try {
    if (this.hash !== "") {

      // Store hash
      var hash = this.hash;
  
      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 1000, function() {
  
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
      return false;
    }
  } catch (error) {
    //nothing
  }
  
});

