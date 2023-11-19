
<html>
<head>
<div id="modal_en">
</head>
<body>
<section class="joinus-content">
<div class="container">
<div class="row">
	<div class="col-lg-12">
	<div class="joinus-form">
		<div class="left">
		   <h2>Send your information</h2>
		</div>
		<div class="right">
			<form name="ContactForm" method="post" enctype="multipart/form-data">

				<input type="hidden" name="jobId" id="jobId" value="{{ $jobId }}">

			  <div class="form-row">                           
				<input type="text" class="form-control" name="name" placeholder="Name" id="name" placeholder="Name">
			  </div>
			  <div class="form-row">                           
				<input type="text" class="form-control" id="phone" name="phone"  placeholder="Phone">

			  </div>
			  <div class="form-row">                           
				<input type="email" class="form-control" id="email" name="email"  placeholder="Email">

			  </div>
			  <!-- <div class="form-row">                           
				
				<input type="file" name="attach" class="form-control" id="attach" placeholder="Attachment">  
			  </div> -->
			   <div class="form-row">                   
                  <div class="file-input">
                    <input type="file" id="file" class="file" name="contact_info">
                    <label for="file">
                      <span class="cv-select">CV  </span>
                      <span class="file-name"></span>
                    </label>
                  </div>
                </div>
			  <div class="form-row">                   
				<div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_CAPTCHA_KEY') }}" data-callback="recaptchaDataCallbackRegister" 
				data-expired-callback="recapchaExpireCallbackRegister"></div>
				<input type="hidden" name="grecaptcha" id="hiddenRecaptchaRegister">
			  </div>
			  <div class="form-row">
				<input type="submit" class="btn btn-success" value="Send">
			  </div>
		   </form>
		   <div class="message_box" style="margin:10px 0px;">
		</div>
	 </div>
	</div>
</div>
</div> 
</div>
</section>
</body>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

function recaptchaDataCallbackRegister(response){
		$('#hiddenRecaptchaRegister').val(response);
}

function recapchaExpireCallbackRegister(){
		$('#hiddenRecaptchaRegister').val('');
}

$(document).ready(function() {
  var delay = 2000;
 
  $('.btn-success').click(function(e){
    e.preventDefault();


   var name = $('#name').val();
   if(name == ''){
	   $('.message_box').html('<span style="color:red;">Enter Your Name!</span>');
       $('#name').focus();
       return false;
   }
   var chackedcaptha = $('#hiddenRecaptchaRegister').val();

   if(chackedcaptha == ''){

	   $('.message_box').html('<span style="color:red;">Oops, you have to check the captcha</span>');
       $('#hiddenRecaptchaRegister').focus();
       return false;
   }
 
   var email = $('#email').val();
   if(email == ''){

	   $('.message_box').html('<span style="color:red;">Enter Email Address!</span>');
	   $('#email').focus();
	   return false;
   }

   // if( $("#email").val()!='' ){
	  //  // if( !isValidEmailAddress( $("#email").val() ) ){
	  //  // $('.message_box').html('<span style="color:red;">Provided email address is incorrect!</span>');
	  //  // $('#email').focus();
   //     return false;
   //     //}

   // }

   var phone = $('#phone').val();
   if(phone == ''){

	   $('.message_box').html('<span style="color:red;">Enter Your Phone</span>');
	   $('#phone').focus();
	   return false;
   }

   var attach = $('#file').val();
   if(attach == ''){

	   $('.message_box').html('<span style="color:red;">Upload your file!</span>');
	   $('#file').focus();
	   return false;
   }


        var _token = "{{ csrf_token() }}";
      	var attach = $('#file').prop('files')[0]; 
        var form_data = new FormData();                  
    	form_data.append('contact_info', attach);
    	form_data.append('name', name);
    	form_data.append('email', email);
		form_data.append('jobId', $('#jobId').val());
    	form_data.append('_token', _token);
    	
	    $.ajax({
	        url: "{{ url('jobs_apply') }}", // point to server-side PHP script 
		        dataType: 'text',  // what to expect back from the PHP script, if anything
		        cache: false,
		        contentType: false,
		        processData: false,
		        data: form_data,                         
		        type: 'post',
	        beforeSend: function() {
				  $('.message_box').html('<img src="assets/ajax-loader.gif" width="25" height="25"/>');
				  $('.btn-success').prop("disabled", true);
			   }, 
			   success: function(data)
			   {
			   	$('.message_box').html(data);
	             window.setTimeout(function () {
	              window.location.reload();
	            }, delay);
		    }
    });
  });
 
});
</script>
</html>