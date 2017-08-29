
<script>
	function numberOnly(numb) {
	
        var numbInput = (numb.which) ? numb.which : event.keyCode
            
			if (numbInput > 31 && (numbInput < 48 || numbInput > 57))
                  return false;
 
            return true;
    }
	
			
	$(document).ready(function() {

		$(".add_qty").click(function(){
			var position = $(this).attr('position');
			var qty = $("#qty\\["+position+"\\]").val();
			qty++;
			$("#qty\\["+position+"\\]").val(qty);
			
		});
		
		$(".less_qty").click(function(){
			var position = $(this).attr('position');
			var qty = $("#qty\\["+position+"\\]").val();
			qty--;
			if(qty >= 0){
				$("#qty\\["+position+"\\]").val(qty);
			}
			
		});
		
		
		$(".add_to_cart").click(function(){
			
			
			var product_id = $(this).attr('product_id');
			var qty = $('.qty'+product_id).val();
			var total_harga = $("#total").val();
			
			if(qty == 0){
				alert('Minumum quantity 1');
				return false;
			} else {
				
				$("#notification_div").html('<div class="alert alert-info" role="alert">Please wait...</div>');
				var dataString  = { product_id  : product_id , qty : qty };
	
	
					$.ajax({
		
						type: "POST",
						url: "<?php echo base_url();?>cart",
						data: dataString,
						dataType: "json",
						cache		: false,
						success: function(data){
	
					
						
							$("#notification_div").html('<div class="alert alert-success" role="alert">Success add to cart...</div>');
							$("#update_cart").html(data.update_cart);
							
				
				
				  
						} ,error: function(xhr, status, error) {
							alert(status);
						},
					});
					
			}
			
		});
		
		$(".update_cart").click(function(){
			
			
			var total = $("#total").val();
			
			if(!total){
				alert('Cart empty');
				return false;
			} 
			
			if(total == 0){
				alert('Cart empty');
				return false;
			} 
			
			var notif = false;
			var qty = new Array();
			var product_id = new Array();
			var product_price = new Array();
			var i = 0;
			var new_total = 0;
			
			$(".qty").each(function(){
				if($(this).val() == 0){
					notif = true;
				}
				qty.push($(this).val());
			});
			
			$(".product_price").each(function(){
				product_price.push($(this).val());
			});
			
			
			
							
			
			
			if(notif == true){
				alert('Minumum quantity 1');
				return false;
			} else {
				
				
				$(".product_id").each(function(){
								product_id.push($(this).val());
								$('#span_total'+$(this).val()).html(product_price[i]*qty[i]);
								new_total += product_price[i]*qty[i];
								i++;
							});
							
							$('#span_all_total').html(new_total);
							$('#total').val(new_total);
			

				$("#notification_div").html('<div class="alert alert-info" role="alert">Please wait...</div>');
				
				var dataString  = { product_id  : product_id , qty : qty };
					
	
					$.ajax({
		
						type: "POST",
						url: "<?php echo base_url();?>cart/update",
						data: dataString,
						dataType: "json",
						cache: false,
						success: function(data){
	
					
							$("#notification_div").html('<div class="alert alert-success" role="alert">Success update cart...</div>');
							$("#update_cart").html(data.update_cart);
							
							
	
				  
						} ,error: function(xhr, status, error) {
							alert(status);
						},
					});
					
					
					
			}
			
		});
		
		$("#submit").click(function(){
			$('.modal-alert').modal('show');
		});
		
		
		
			
		$(".delete_cart").click(function(){
			
	
			var x = confirm("Delete item ?");
			var product_id = $(this).attr('product_id');
			var total = $("#total").val();
			var position = $(this).attr('position');
			
			var product_price = $("#product_price\\["+position+"\\]").val();
			var qty = $("#qty\\["+position+"\\]").val();
			
			var price_delete = product_price*qty;
			var new_total = eval(total - price_delete);
			
			
			if(x == true){
			
			
				$("#notification_div").html('<div class="alert alert-info" role="alert">Please wait ...</div>');
				
				var dataString  = { product_id  : product_id };
				$.ajax({
		
						type: "POST",
						url: "<?php echo base_url();?>cart/delete",
						data: dataString,
						dataType: "json",
						cache		: false,
						success: function(data){
	
							$("#tr"+product_id).remove();
							$("#notification_div").html('<div class="alert alert-success" role="alert">Success delete item ...</div>');
							
							
							$('#total').val(new_total);
							$('#span_all_total').html(new_total);
					
							if(new_total == 0){
								$('#tr_total').remove();
								$('#tb_checkout').append(' <td colspan="6" align="center">Cart empty</td>');
								$('#button_bottom').hide();
							}
							
							$("#update_cart").html(data.update_cart);
				  
						} ,error: function(xhr, status, error) {
							alert(status);
						},
					});
					
					
				
			} else {
				return false;
			}
			
		});
		
		
		$(".empty_cart").click(function(){
			
			var total = $("#total").val();
			
			if(!total){
				alert('Cart empty');
				return false;
			} 
			
			if(total == 0){
				alert('Cart empty');
				return false;
			} 
	
			var x = confirm("Empty cart ?");

			if(x == true){
			
			
				$("#notification_div").html('<div class="alert alert-info" role="alert">Please wait ...</div>');
				
				var dataString  = { send  : true };
				$.ajax({
		
						type: "POST",
						url: "<?php echo base_url();?>cart/empty-cart",
						data: dataString,
						dataType: "json",
						cache		: false,
						success: function(data){
	
						
							$("#notification_div").html('<div class="alert alert-success" role="alert">Success empty cart ...</div>');
							$('#tr_total').remove();
							$('#tb_checkout').html(' <td colspan="6" align="center">Cart empty</td>');
							$('#button_bottom').hide();
							$("#update_cart").html(data.update_cart);
				  
						} ,error: function(xhr, status, error) {
							alert(status);
						},
					});
					
					
				
			} else {
				return false;
			}
			
		});
		
		
	});
</script>