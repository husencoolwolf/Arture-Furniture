$(document).ready(function () {
  $('.quantity-control').click(function(){
    var quantity = Number($('#quantity').val());
    if($(this).attr('id') == 'minus-quantity'){
      // console.log($('#quantity').val());
      if(quantity>1){
        $('#quantity').val(quantity - 1);
      }
      
    }else{
      if(quantity<10){
        $('#quantity').val(quantity + 1);
      }
    }
  });

  $('#quantity').change(function(){
    var val = $(this).val();
    if(val<1){
      $(this).val(1);
    }else if(val>10){
      $(this).val(10);
    }
  });
    

});