$('input[name="type"]').click(function(e) {
  if(e.target.value === '1') {
    $('#link').show();
    $('#pdf').hide();
  } else {
    $('#link').hide();
    $('#pdf').show();
  }
})
$('#pdf').hide();

$(document).ready(function () {                            
    if ($("[name='type'][checked]").attr("value")==0) {
      $('#link').hide();
      $('#pdf').show();  
    }
    if ($("[name='type'][checked]").attr("value")==1) {
      $('#link').show();
      $('#pdf').hide(); 
    }
});


/*annual type*/
$('input[name="a_type"]').click(function(e) {
  if(e.target.value === '1') {
    $('#a_link').show();
    $('#a_pdf').hide();
  } else {
    $('#a_link').hide();
    $('#a_pdf').show();
  }
})



$(document).ready(function () {                            
    
    if ($("[name='a_type'][checked]").attr("value")==0) {
      $('#a_link').hide();
      $('#a_pdf').show();  
    }

    if ($("[name='a_type'][checked]").attr("value")==1) {
      $('#a_link').show();
      $('#a_pdf').hide(); 
    }

});

/*basel type*/
$('input[name="b_type"]').click(function(e) {
  if(e.target.value === '1') {
    $('#b_link').show();
    $('#b_pdf').hide();
  } else {
    $('#b_link').hide();
    $('#b_pdf').show();
  }
})



$(document).ready(function () {                            
    if ($("[name='b_type'][checked]").attr("value")==0) {
      $('#b_link').hide();
      $('#b_pdf').show();  
    }
    if ($("[name='b_type'][checked]").attr("value")==1) {
      $('#b_link').show();
      $('#b_pdf').hide(); 
    }

});

/*profit type*/
$('input[name="p_type"]').click(function(e) {
  if(e.target.value === '1') {
    $('#p_link').show();
    $('#p_pdf').hide();
  } else {
    $('#p_link').hide();
    $('#p_pdf').show();
  }
})

$(document).ready(function () {                            
    if ($("[name='p_type'][checked]").attr("value")==0) {
      $('#p_link').hide();
      $('#p_pdf').show();  
    }
    if ($("[name='p_type'][checked]").attr("value")==1) {
      $('#p_link').show();
      $('#p_pdf').hide(); 
    }

});



/*arabic section*/

$('input[name="f_type_ar"]').click(function(e) {
  if(e.target.value === '1') {
    $('#f_link_ar').show();
    $('#f_pdf_ar').hide();
  } else {
    $('#f_link_ar').hide();
    $('#f_pdf_ar').show();
  }
})


$(document).ready(function () {                            
    if ($("[name='f_type_ar'][checked]").attr("value")==0) {
      $('#f_link_ar').hide();
      $('#f_pdf_ar').show();  
    }
    if ($("[name='f_type_ar'][checked]").attr("value")==1) {
      $('#f_link_ar').show();
      $('#f_pdf_ar').hide(); 
    }
});

/*annual arebic*/
$('input[name="a_type_ar"]').click(function(e) {
  if(e.target.value === '1') {
    $('#a_link_ar').show();
    $('#a_pdf_ar').hide();
  } else {
    $('#a_link_ar').hide();
    $('#a_pdf_ar').show();
  }
})


$(document).ready(function () {                            
    if ($("[name='a_type_ar'][checked]").attr("value")==0) {
      $('#a_link_ar').hide();
      $('#a_pdf_ar').show();  
    }
    if ($("[name='a_type_ar'][checked]").attr("value")==1) {
      $('#a_link_ar').show();
      $('#a_pdf_ar').hide(); 
    }
});
/*basel arebic*/
$('input[name="b_type_ar"]').click(function(e) {
  if(e.target.value === '1') {
    $('#b_link_ar').show();
    $('#b_pdf_ar').hide();
  } else {
    $('#b_link_ar').hide();
    $('#b_pdf_ar').show();
  }
})


$(document).ready(function () {                            
    if ($("[name='b_type_ar'][checked]").attr("value")==0) {
      $('#b_link_ar').hide();
      $('#b_pdf_ar').show();  
    }
    if ($("[name='b_type_ar'][checked]").attr("value")==1) {
      $('#b_link_ar').show();
      $('#b_pdf_ar').hide(); 
    }
});

/*profit arebic*/
$('input[name="p_type_ar"]').click(function(e) {
  if(e.target.value === '1') {
    $('#p_link_ar').show();
    $('#p_pdf_ar').hide();
  } else {
    $('#p_link_ar').hide();
    $('#p_pdf_ar').show();
  }
})


$(document).ready(function () {                            
    if ($("[name='p_type_ar'][checked]").attr("value")==0) {
      $('#p_link_ar').hide();
      $('#p_pdf_ar').show();  
    }
    if ($("[name='p_type_ar'][checked]").attr("value")==1) {
      $('#p_link_ar').show();
      $('#p_pdf_ar').hide(); 
    }
});

