


$(document).ready(function()
	{
		$('button.navbar-toggler').on('click', function(){
				$('div#collapsibleMenu').toggle();
		}); 
		
		
		$('.selectQty').on('change', function(){
				var fid = this.getAttribute('fid'); 
				var qty = this.value; 
				
				$.ajax( {type: 'GET', 
					cache: false, 
					url: 'cart/changeQty/' + fid + '/' + qty,
					success: function(msg)
							{
								if(msg != 1)
									alert('That didn\'t work. Try again');
							}
						});
		}); 
		
		$('#emptyCart').on('click', function(){
			return confirm("Are you sure?\nThis action will empty your cart");
		}); 
		
		
		
	}); 