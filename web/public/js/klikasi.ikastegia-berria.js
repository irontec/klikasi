$(window).load(function() {
    
    var baseUrl = $('base').attr('href');
    
    var ikastegiaBerriaActionUrl = baseUrl + 'ikastegia-berria';
    
    if ($('input[data-plugin="avatarSelector"]').length > 0) {
        $('input[data-plugin="avatarSelector"]').avatarSelector();
    }

    if ($('input[data-plugin="gmaps"]').length > 0) {
        $('input[data-plugin="gmaps"]').gmaps();
    }

    /**
     * Submit form
     */
    var ikastegiaBerriaForm = $('#ikastegiaBerria-form');

    ikastegiaBerriaForm.keypress(function(e) {

        if ($(e.target).attr("id") == "helbideKutxa" && e.keyCode == 13) {            
            return false;
        }
    });

    var ikastegiMota = $("#ikastegimota");
    $("#mota").change(function (e) {

        if ($(this).val() == "bestelakoa") {
            ikastegiMota.prop("disabled", false);
        } else {
            ikastegiMota.prop("disabled", true);
        }
    });

    ikastegiaBerriaForm.on('submit', function(event) {

        console.log(event);
        event.preventDefault();
        
        var dataForm = ikastegiaBerriaForm.serializeArray();
        
        $('#ikastegia-errors').addClass('hide');
        $('#ikastegia-errors').html('');
        
        $.each($('.has-error'), function(key, val) {
            $(val).removeClass('has-error');
            $(val).find('.error').remove();
        });
        
        $.ajax({
            url: ikastegiaBerriaActionUrl,
            type: 'POST',
            dataType: 'json',
            data: dataForm,
            success: function(data) {

                if(data.errors === undefined) {
                    
                    window.location = baseUrl + 'ikastegiak'
                    
                } else {
                    
                    $('#ikastegia-errors').removeClass('hide');
                    
                    $.each(data.errors, function(key, val) {
                        
                        var elementError = $(ikastegiaBerriaForm).find('#' + key);
                        elementError.parents('.element-group').addClass('has-error');
                        elementError.parents('.element-group').append($('<span>').html(val).addClass('msg error'));
                        
                        $('#ikastegia-errors').append('<p>' + val + '</p>')
                    });
                    
                    $('html, body').animate({
                        scrollTop: '50px'
                    }, 1850);
                    
                }
            },
            error:function(data) {
                console.error(data);
            }
        });
        
    });
    
    /**
     * Contador de caractes para la descripción corta.
     */
    function lengthDeskribapenLaburra() {
        var count = $('#deskribapenLaburra').val().length;
        $('.countCharactes').text(140 - count);
        var block = $('.countCharactes').parents('.help-block');
        
        if (count > 140) {
            
            block.addClass('error');
            
            $('.alert-countCharactes').removeClass('hide');
            
        } else {
            
            block.removeClass('error');
            
            $('.alert-countCharactes').addClass('hide');
        }
    }
    
    $('#deskribapenLaburra').on('keyup', function() {
        lengthDeskribapenLaburra();
    });
    
    $('#deskribapenLaburra').on('change', function() {
        lengthDeskribapenLaburra();
    });
    
    var count = $('#deskribapenLaburra').val().length;
    $('.countCharactes').text(140 - count);
    
/**
     * Avatar
     */
    $('#button-file-avatar').on('click', function(event) {
        event.preventDefault();
        $('#avatar').click();
        return false;
    });


    var cropAvatar = function() {
        var r = $('#results-avatar');
        var x = $('[name=cropX]');
        var y = $('[name=cropY]');
        var w = $('[name=cropW]');
        var h = $('[name=cropH]');

        $('#cropimage').cropbox({
            width: 200,
            height: 200
        }).on('cropbox', function (event, results, img) {
            x.val(results.cropX);
            y.val(results.cropY);
            w.val(results.cropW);
            h.val(results.cropH);
        });
    };

    cropAvatar();
    $('#avatar').on('change', function(event) {
         
         /**
          * upload
          */
         var archivos = document.getElementById('avatar');
         var archivo = archivos.files;

         if(window.XMLHttpRequest) { 
             var Req = new XMLHttpRequest(); 
         }else if(window.ActiveXObject) { 
             var Req = new ActiveXObject("Microsoft.XMLHTTP"); 
         }

         var data = new FormData();

         for(i=0; i<archivo.length; i++){
            data.append('avatar', archivo[i]);
         }

         console.log("url", $('[name=url]').val());
         Req.open(
             'POST',
             baseUrl + 'ikastegia-berria/upload-custom-avatar',
             true
         );

         Req.onload = function(Event) {
             if (Req.status == 200) {
                 
                 console.log("req", Req);
                 
                 var uploadResult = JSON.parse(Req.responseText);
                 
                 if (uploadResult.status) {
                     
                     if (document.getElementById('avatar').files[0] != undefined) {
                         
                         $('#tmpName').val(uploadResult.tmpName);
                         
                         var oFReader = new FileReader();
                         oFReader.readAsDataURL(document.getElementById('avatar').files[0]);
                         
                         setTimeout(function() {
                             
                             $('#cropimage').attr('src', oFReader.result);
                             cropAvatar();
                             
                         }, 100);
                         
                     }
                 } else {
                     alert('Okerreko formatoa');
                 }
                 
             } else { 
                 console.log(Req.status);
             }
         };

         Req.send(data);
         
     });
    
    
});