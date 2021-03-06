
/*Loader functions*/
function showLoader()
{
  $('#loader').show();
}

function hideLoader()
{
  $('#loader').hide();
}

showLoader();
/*fin Loader functions*/


(function($) {

    //Browser placeholder compatibility checker
    jQuery.support.placeholder = (function(){
        var i = document.createElement('input');
        return 'placeholder' in i;
    })();

    $(document).ready(function() {

        var fixedHeightNavbar = $('header:eq(0)').height() + 5;
        $("header:eq(0)").attr("style", "height:" + fixedHeightNavbar + "px!important");

        var heightNavbar = $('header:eq(0) nav:eq(1)').height();
        var widthNavbar = $('header:eq(0) .navbar').width();
        var widescreen = widthNavbar > 758;

        var bilatu = $("li.bilatu:visible");

        $(window).on('resize', function () {
            heightNavbar = $('header:eq(0) nav:eq(0)').height() + $('header:eq(0) nav:eq(2)').height();
            widthNavbar = $('header:eq(0) .navbar').width();
            widescreen = widthNavbar > 758;
        });

        $(window).on('scroll', function() {

            if ($(window).scrollTop() > heightNavbar) {

                if (!$("header > div.navbar").hasClass("navbar-fixed-top")) {
                    if (widescreen) {

                        $("header > div.navbar").addClass("navbar-fixed-top");
                        $("nav:lt(-2), #mega-menu > ul").hide();

                        $("#mega-menu").addClass("hidden-xs").addClass("scroll-menu").removeClass("nav-full");
                        $("#mega-menu > ul.nav li:eq(0)").removeClass("hide");
                        $("#mega-menu > ul.nav li:gt(0):lt(-1)").removeClass("col-xs-6");

                        if (!bilatu.hasClass("open")) {
                            $("nav:eq(0),#mega-menu > ul").fadeIn();
                        } else {
                            $("nav:eq(0),#mega-menu > ul").show();
                        }

                    } else {

                        //Dispositivos móviles
                        return;
                        $("header > div.navbar").addClass("navbar-fixed-top");
                        $("nav:lt(-2), #mega-menu > ul").hide();

                        if (!bilatu.hasClass("open")) {
                            $("nav:eq(0),#mega-menu > ul").fadeIn();
                        } else {
                            $("nav:eq(0),#mega-menu > ul").show();
                        }
                    }
                }

            } else if ($("header > div.navbar").hasClass("navbar-fixed-top")) {
                $("header > div.navbar").removeClass("navbar-fixed-top");

                $("#mega-menu").removeClass("hidden-xs").removeClass("scroll-menu").addClass("nav-full");
                $("#mega-menu > ul.nav li:eq(0)").addClass("hide");
                $("#mega-menu > ul.nav li:gt(0):lt(-1)").addClass("col-xs-6");

                if (widescreen) {
                    $("nav:lt(-2)").css("display", "block");
                } else {
                    $("nav:lt(-2)").attr("style", "");
                }
            }
        });

        var searchForm = $("#mega-menu li.bilatu form");
        $("#mega-menu a.dropdown-toggle").on("click", function (e) {
            
            if(!$(this).parent().hasClass("open")) {
                //searchForm.find("input:eq(0)").focus();
                var inputFld = searchForm.find("input:eq(0)");
                setTimeout(function(){inputFld.focus();}, 300);
            }
        });

        $('#search-adina').slider({
            tooltip: 'hide'
        }).on('slide', function(ev){

            var element = $(this);
            var value = element.val();
            element.val(value);

            var values = value.split(',');

            if (values[0] == '') {
                searchForm.find('.min-years').text(10);
            } else {
                searchForm.find('.min-years').text(values[0]);
            }

            if (values[1] == '') {
                searchForm.find('.max-years').text(25);
            } else {
                searchForm.find('.max-years').text(values[1]);
            }
        });

        searchForm.find(".search-formbutton")
            .on("click", "a.iragazi", function (e) {

                e.preventDefault();
                e.stopPropagation();
                $(this).parents("form").submit();

            }).on("click", "a.refresh", function (e) {

                e.preventDefault();
                e.stopPropagation();
                $(this).parents("form").get(0).reset();

            }).on("click", "a.angle", function (e) {

                e.preventDefault();
                e.stopPropagation();

                var formElements = searchForm.find("input,select").filter(":gt(0)");

                if ($(this).css("transform") != "none" && $(this).css("transform") != "") {
                    formElements.removeAttr("disabled");
                } else {
                    formElements.attr("disabled", "disabled");
                }

                searchForm.find("input,select").filter(":gt(0)");
                if ($(this).attr("style") == "") {
                    $(this).attr("style", 'transform:rotate(180deg); -ms-transform:rotate(180deg); -webkit-transform:rotate(180deg);');
                } else {
                    $(this).attr("style", '');
                }

                $(this).parents("form").find(".toggle").toggle();
            });

        searchForm.find("select[name='searchkategoria[]']").select2();
        
        /*searchForm.find*/
       $("input[name=searchdatefrom],input[name=searchdateto]").datepicker({
            language: "eu",
            format: "yyyy-mm-dd",
            autoclose: "true",
            startDate: "2010-01-01",
            endDate: new Date(),
            startView: 2,
        }).on('show', function(e) {

            var $popup = $('.datepicker');
            $($popup.get(1)).css("z-index", 1060);
            $popup.click(function () { return false; });
        });

        if (!$.support.placeholder) {
            $('form').find('input, textarea').placeholder();
        }
    });
})(jQuery);

$(document).on('click', '.mega-menu .dropdown-menu', function(e) {
  e.stopPropagation();
});

$(document).ready(function() {

    /*___Swipe in carousel___*/
    if($('.carousel').length)
    {
      var carousels = document.getElementsByClassName('carousel');
      if(carousels.length > 0)
      {
        var carouselInner = $(carousels[0]).find("div.carousel-inner");
        var elements = carouselInner.find("div.elem");
        var width = $(elements.get(0)).width() * elements.length;

        if (width > 0 && width < carouselInner.width()) {
            carouselInner.parent().find(".carousel-control").hide();
        }

        for(var i = 0 ; i < carousels.length ; i++)
        {
          Hammer(carousels[i]).on("dragright", function() {
            $(this).carousel('prev');
          });
          Hammer(carousels[i]).on("dragleft", function() {
              $(this).carousel('next');
          });
        }
      }
    }
    /*___End swiipe in carousel___*/

    /*___Tab collapse initialization___*/

    // $('#tab-recursos').tabCollapse({
        // tabsClass: 'hidden-xs',
        // accordionClass: 'visible-xs'
    // });

    /*___End Tab collapse initaization___*/


    /*___Isotope initialization___*/



    /*___End isotope initialization___*/


    /*___Tooltip inizialization___*/

    $(".tooltip-examples a").tooltip({
        placement : 'top'
    });

    /*___End Tooltip inizialization___*/

    /*_________Parallax____________*/
    // cache the window object
   $window = $(window);

   $('.scroll-parallax[data-type="background"]').each(function(){
     // declare the variable to affect the defined data-type
     var $scroll = $(this);

      $(window).scroll(function() {
        // HTML5 proves useful for helping with creating JS functions!
        // also, negative value because we're scrolling upwards
        var yPos = -($window.scrollTop() / $scroll.data('speed'));

        // background position
        var coords = '50% '+ yPos + 'px';

        // move the background
        $scroll.css({ backgroundPosition: coords });
      }); // end window scroll
   });  // end section function
   /*_________Fin Parallax__________*/
});


/*Hide loader*/

$(window).load(function(){
  hideLoader();
  $('#main-content').addClass('loaded');
});




/*______IZENA EMAN FORM______*/
// $('#tab-izenaeman').tabCollapse({
//         tabsClass: 'hidden-xs',
//         accordionClass: 'visible-xs'
//     });

/*Datepicker*/
    $('.datepicker').datepicker();
/*Fin Datepicker*/

/*Imagepicker*/
//$(".image-picker").imagepicker()
/*Fin Imagepicker*/
/*______End IZENA EMAN FORM______*/

/*______SARTU______*/

/*______End SARTU______*/


