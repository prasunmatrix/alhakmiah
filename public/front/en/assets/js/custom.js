
$('.heroslide').owlCarousel({
  smartSpeed: 500,
  items: 1, 
  loop:true,
  autoplay:true,
  autoplayTimeout:8000,
  margin: 0,
  nav: false,
  dots: false
});


$('.prop-slide').owlCarousel({
  loop:true,
  smartSpeed: 500,
  items: 3,  
  margin: 30,
  nav: true,
  dots: false,
  responsive:{
    0:{items:1},
    600:{items:2},
    1000:{items:3}
  }
});


$('.archive-slide').owlCarousel({
  smartSpeed: 500,
  loop:true,
  items: 1, 
  margin: 0,
  // autoplay:true,
  nav: true,
  dots: false
});



$('.mobClick').click(function() {
  $(this).toggleClass('open');
  $('.site-nav').toggleClass('act');
  $('body').toggleClass('navOpen');
  $('.nav-overlay').toggleClass('act');
});


$(".site-nav ul li a").each(function(){
  if($(this).parent().find('ul').length > 0){
   $(this).parent().prepend('<span class="subDropAlt"></span>');
   $(this).parent().addClass('has-sub');
  }else{
  }
});

$('.subDropAlt').click(function(){
  $(this).parent().find('> ul').slideToggle();
});



$( document ).ready(function() {

  AOS.init({
    delay: 0,
    duration: 200,
  });

  $('.al-hakiam_tabSlider').owlCarousel({
    
    dots:false,
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
  })

});



$('#newsslider').owlCarousel({
    autoplay:true,  
    autoplayTimeout: 9000, 
    loop: true,   
    nav:true,
    dots: false,
    margin:30,       
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
         992:{
            items:2,
            nav:true
        }
    }
});   


$('#mediaslider').owlCarousel({
    autoplay:true,  
    autoplayTimeout: 9000, 
    loop: true,   
    nav:true,
    dots: false,
    margin:30,       
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        768:{
            items:2,
            nav:true
        },
         992:{
            items:3,
            nav:true
        }
    }
}); 

// search drop

$('.search').click(function(){
  $('.drop-search').toggleClass('open');
});

$('.search-close').click(function(){
  $('.drop-search').removeClass('open');
});


//menu over pic

$(document).ready(function(){
  $('.menu-pic').mouseover(function() {
    pmenuvar = this.id;
    $("div.item-img-single").hide();
    $('#div'+pmenuvar).show();
  });

  $('.menu-pic-community').mouseover(function() {
    community = this.id;
    $("div.item-img-single-community").hide();
    $('#div_'+community).show();
  });

  $('.communitu-main-menu').mouseover(function() {
    communityId = $(this).data('cid');
    $("div.item-img-single-community").hide();
    $('#div_community_'+communityId).show();
  });

  $('.menu-pic-investor').mouseover(function() {
    pp = $(this).data('cid');
    $(".item-img-single-investor").hide();
    $('#divmenux_'+pp).show();
  });
});

// scroll down 
$(document).ready(function(){
  $("#scroll-down").click(function() {    
      $('html, body').animate({
          scrollTop: $("#welcome").offset().top
      }, 2000);
  });

});

const file = document.querySelector('#file');
file.addEventListener('change', (e) => {
  // Get the selected file
  const [file] = e.target.files;
  // Get the file name and size
  const { name: fileName, size } = file;
  // Convert size in bytes to kilo bytes
  const fileSize = (size / 1000).toFixed(2);
  // Set the text content
  const fileNameAndSize = `${fileName} - ${fileSize}KB`;
  document.querySelector('.file-name').textContent = fileNameAndSize;
});


