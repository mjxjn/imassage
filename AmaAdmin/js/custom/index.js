jQuery(document).ready(function(){
								
	///// TRANSFORM CHECKBOX /////							
	jQuery('input:checkbox').uniform();
	
	///// LOGIN FORM SUBMIT /////
	jQuery('#login').submit(function(){
	
		if(jQuery('#username').val() == '' && jQuery('#password').val() == '') {
			jQuery('.nousername').fadeIn();
			jQuery('.nopassword').hide();
			return false;	
		}
		if(jQuery('#username').val() != '' && jQuery('#password').val() == '') {
			jQuery('.nopassword').fadeIn().find('.userlogged h4, .userlogged a span').text(jQuery('#username').val());
			jQuery('.nousername,.username').hide();
			return false;
		}else{
			var formParam = jQuery("#login").serialize();
			
			jQuery.ajax({
				type:'post',        
		        url:'/index.php/admin/Login/ajaxlogin',    
		        data:formParam,    
		        cache:false,    
		        dataType:'json',
		        success:function(data){

		        	if(data.data){    		
		        		self.location='/index.php/admin/index'; 
		        	}else{
		        		jQuery('.nopassword').fadeIn().find('.userlogged h4, .userlogged a span').text(jQuery('#username').val());
						jQuery('.nousername,.username').hide();
						return false;
		        	}
		        }
			});
			return false;
		}
	});
	
	///// ADD PLACEHOLDER /////
	jQuery('#username').attr('placeholder','Username');
	jQuery('#password').attr('placeholder','Password');
});