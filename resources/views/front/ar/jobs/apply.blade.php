 <html>
<head>
<div id="modal_ar">
</head>
<body>

<section class="joinus-content">
<div class="container">
	<div class="row">
<div class="col-lg-12"> 
<div class="joinus-form">
	<div class="left">
	   <h2>ارسل  <br>
		 معلوماتك
	   </h2>
	</div>
	<div class="right">
	   <form name="ContactForm" method="post" method="post" enctype="multipart/form-data">

		<input type="hidden" name="jobId" id="jobId" value="{{ $jobId }}">
		  <div class="form-row">                           
			 <input name="name" type="text" placeholder="الأسم" id="name">
		  </div>
		  <div class="form-row">
			<input name="phone" type="text" id="phone" placeholder="رقم الجوال ">
		 </div>
		  <div class="form-row">                           
			 <input name="email" type="email" placeholder="البريد الالكتروني" id="email">  
		  </div>
		  <!-- <div class="form-row">                           
			<input type="file" name="contact_info" class="form-control" id="attach" placeholder=" ملف">
		  </div> -->
		  <div class="form-row">                   
              <div class="file-input">
                <input type="file" id="file" class="file" name ="contact_info">
                <label for="file">
                  <span class="cv-select">سيرة الذاتية  </span>
                  <span class="file-name"></span>
                </label>
              </div>
           </div>
		  <div class="form-row">                   
			<div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_CAPTCHA_KEY') }}" data-callback="recaptchaDataCallbackRegister" 
				data-expired-callback="recapchaExpireCallbackRegister"></div>
				<input type="hidden" name="grecaptcha" id="hiddenRecaptchaRegister1">
		  </div>
		  <div class="form-row">
			<input type="submit" class="btn btn-success" value="إرسال">
		  </div>
	   </form>
	   <div class="message_box" style="margin:10px 0px;">
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
	
		$('#hiddenRecaptchaRegister1').val(response);

}

function recapchaExpireCallbackRegister(){
		$('#hiddenRecaptchaRegister1').val('');
}

$(document).ready(function() {
  var delay = 2000;
  $('.btn-success').click(function(e){
    e.preventDefault();


   var name = $('#name').val();
   if(name == ''){
	   $('.message_box').html('<span style="color:red;">أدخل أسمك!</span>');
       $('#name').focus();
       return false;
   }
   var chackedcaptha = $('#hiddenRecaptchaRegister1').val();

   if(chackedcaptha == ''){

	   $('.message_box').html('<span style="color:red;">عفوًا ، يجب عليك التحقق من كلمة التحقق</span>');
       $('#hiddenRecaptchaRegister1').focus();
       return false;
   }
 
   var email = $('#email').val();
   if(email == ''){

	   $('.message_box').html('<span style="color:red;">أدخل عنوان البريد الالكتروني!</span>');
	   $('#email').focus();
	   return false;
   }

    var phone = $('#phone').val();
   if(phone == ''){

	   $('.message_box').html('<span style="color:red;">رقم الهاتف مطلوب!</span>');
	   $('#phone').focus();
	   return false;
   }

   var attach = $('#file').val();
   if(attach == ''){

	   $('.message_box').html('<span style="color:red;">ارفع ملفك!</span>');
	   $('#file').focus();
	   return false;
   }


   // if( $("#email").val()!='' ){
	  //  // if( !isValidEmailAddress( $("#email").val() ) ){
	  //  // $('.message_box').html('<span style="color:red;">Provided email address is incorrect!</span>');
	  //  // $('#email').focus();
   //     return false;
   //     //}

   // }



		var _token = "{{ csrf_token() }}";
      	var attach = $('#file').prop('files')[0]; 
        var form_data = new FormData();                  
    	form_data.append('contact_info', attach);
    	form_data.append('name', name);
    	form_data.append('phone', phone);
    	form_data.append('email', email);
		form_data.append('jobId', $('#jobId').val());
    	form_data.append('_token', _token);
    	
	    $.ajax({
	        url: "{{ url('ar/jobs_apply') }}",
		        dataType: 'text',  // what to expect back from the PHP script, if anything
		        cache: false,
		        contentType: false,
		        processData: false,
		        data: form_data,                         
		        type: 'post',

		   beforeSend: function() {
			  $('.message_box').html('<img src="assets/uploads/ajax-loader.gif" width="25" height="25"/>');
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