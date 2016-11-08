$(window).load(function() {
    
    var baseUrl = $('base').attr('href');
    
    var ikastegiaAdministrazioanActionUrl = baseUrl + 'ikastegia-administrazioan/datuak/ikastegia/';
    var acceptEdukiakActionUr = baseUrl + 'ikastegia-administrazioan/accept-edukia/ikastegia/';
    var nireEdukiakActionUrl = baseUrl + 'ikastegia-administrazioan/nire-edukia/ikastegia/';
    var moderateIrakasleaActionUrl = baseUrl + 'ikastegia-administrazioan/moderate-irakaslea/ikastegia/';
    var moderateIkasleaActionUrl = baseUrl + 'ikastegia-administrazioan/moderate-ikaslea/ikastegia/';
    var uploadAvatarActionUrl = baseUrl + 'ikastegia-administrazioan/upload-custom-avatar/ikastegia/';
    
    if ($('input[data-plugin="gmaps"]').length > 0) {
        $('input[data-plugin="gmaps"]').gmaps();
    }
    
    $('#tab-recursos button').tooltip({
        placement: 'bottom',
    });
    
    var errorMesagge = $('#errorMesagge');
    var successMessage = $('#successMessage');
    
    $('[data-toggle=tab]').on('click', function() {
        errorMesagge.addClass('hide').html('');
        successMessage.addClass('hide').html('');
    });

    /**
     * Submit form
     */
    var ikastegiaEditForm = $('#ikastegia-edit-form');

    ikastegiaEditForm.keypress(function(event) {
        
        var elementId = $(event.target).attr('id');
        
        if (elementId == 'helbideKutxa' && event.keyCode == 13) {
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
    
    ikastegiaEditForm.on('submit', function(event) {
        event.preventDefault();
        
        errorMesagge.addClass('hide').html('');
        successMessage.addClass('hide').html('');
        
        var dataForm = ikastegiaEditForm.serializeArray();
        
        $.each($('.has-error'), function(key, val) {
            $(val).removeClass('has-error');
            $(val).find('.customError').remove();
        });
        
        var actionUrl = ikastegiaAdministrazioanActionUrl + $('[name=url]').val();
        
        $.ajax({
            url: actionUrl,
            type: 'POST',
            dataType: 'json',
            data: dataForm,
            success: function(data) {
                
                if(data.status) {
                    
                    successMessage.removeClass('hide');
                    successMessage.append($('<p>').text(data.message));
                    
                } else {
                    
                    errorMesagge.removeClass('hide');
                    
                    if (typeof data.errors == 'string') {
                        errorMesagge.append('<p>' + data.errors + '</p>')
                    } else {
                        $.each(data.errors, function(key, val) {
                            
                            var elementError = $(ikastegiaEditForm).find('#' + key);
                            elementError.parents('.element-group').addClass('has-error');
                            elementError.parents('.element-group').append($('<span>').html(val).addClass('msg error customError'));
                            
                            errorMesagge.append('<p>' + val + '</p>')
                            
                        });
                    }
                    
                }
                
                $('html, body').animate({
                    scrollTop: '50px'
                }, 1850);
                
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
     * Nire Edukiak
     * unlink
     */
    $('[data-action=unlinkEdukia]').on('click', function(event) {
        event.preventDefault();
        
        var element = $(this);
        var dataRelation = element.attr('data-relation');
        var divContainer = $('.notificationCustomRow[data-relation=' + dataRelation + ']');
        errorMesagge.addClass('hide').html('');
        successMessage.addClass('hide').html('');
        
        var actionUrl = nireEdukiakActionUrl + $('[name=url]').val();
        
        $.ajax({
            url: actionUrl,
            type: 'POST',
            dataType: 'json',
            data: {
                edukiaId: dataRelation
            },
            success: function(data) {
                
                if(data.status) {
                    
                    divContainer.html($('<p>').text(data.message)).addClass('alert-warning');
                    
                    setTimeout(function() {
                        divContainer.slideUp('slow', function() {
                            divContainer.remove();
                            
                            if ($('#nireEdukiakOnartua .notificationCustomRow').length == 0) {
                                $('.noMoreNireEdukiak').removeClass('hide');
                            }
                        });
                        
                    }, 1850);
                    
                } else {
                    
                    errorMesagge.removeClass('hide');
                    errorMesagge.append('<p>' + data.message + '</p>')
                    
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
     * Accept
     */
    $('[data-action=acceptEdukia]').on('click', function(event) {
        event.preventDefault();
        
        var element = $(this);
        var dataRelation = element.attr('data-relation');
        var divContainer = $('.notificationCustomRow[data-relation=' + dataRelation + ']');
        
        errorMesagge.addClass('hide').html('');
        successMessage.addClass('hide').html('');
        
        var actionUrl = acceptEdukiakActionUr + $('[name=url]').val();
        
        $.ajax({
            url: actionUrl,
            type: 'POST',
            dataType: 'json',
            data: {
                edukiaId: dataRelation
            },
            success: function(data) {
                
                if(data.status) {
                    
                    element.parent().html($('<p>').text(data.message));
                    
                } else {
                    
                    errorMesagge.removeClass('hide');
                    errorMesagge.append('<p>' + data.message + '</p>')
                    
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
     * Nire Irakasleak
     */
    var moderationIrakasleak = function(element, instance) {
        var dataRelation = element.attr('data-relation');
        var divContainer = $('.notificationCustomRow[data-relation=' + dataRelation + ']');
        
        errorMesagge.addClass('hide').html('');
        successMessage.addClass('hide').html('');
        
        var actionUrl = moderateIrakasleaActionUrl + $('[name=url]').val();
        
        $.ajax({
            url: actionUrl,
            type: 'POST',
            dataType: 'json',
            data: {
                relIrakaslea: dataRelation,
                moderation: instance
            },
            success: function(data) {
                
                divContainer.find('.irakasleaModerationStatus').append($('<p>').text(data.message));
                
                if(data.status) {
                    
                    var egoera = divContainer.find('.egoera');
                    
                    if (instance == 'acceptIrakaslea') {
                        
                        egoera.text('onartua');
                        
                        divContainer.find('[data-action=acceptIrakaslea]').addClass('hide');
                        
                    } else if (instance == 'rejectIrakaslea') {
                        
                        egoera.text('ez onartua');
                        
                        divContainer.find('[data-action=rejectIrakaslea]').addClass('hide');
                        
                    }
                    
                    setTimeout(function() {
                        var message = divContainer.find('.irakasleaModerationStatus p');
                        
                        message.remove();
                        
                        if (instance == 'acceptIrakaslea') {
                            divContainer.find('[data-action=rejectIrakaslea]').removeClass('hide');
                        } else if (instance == 'rejectIrakaslea') {
                            divContainer.find('[data-action=acceptIrakaslea]').removeClass('hide');
                        }
                        
                    }, 1850);
                    
                } else {
                    
                    errorMesagge.removeClass('hide');
                    errorMesagge.append('<p>' + data.message + '</p>')
                    
                    $('html, body').animate({
                        scrollTop: '50px'
                    }, 1850);
                    
                }
                
            },
            error:function(data) {
                console.error(data);
            }
        });
        
        
    };
    
    $('[data-action=acceptIrakaslea]').on('click', function() {
        moderationIrakasleak($(this), 'acceptIrakaslea');
    });
    
    $('[data-action=rejectIrakaslea]').on('click', function() {
        moderationIrakasleak($(this), 'rejectIrakaslea');
    });
    
    /**
     * Nire Ikasleak
     */
    var moderationIkasleak = function(element, instance) {
        var dataRelation = element.attr('data-relation');
        var divContainer = $('.notificationCustomRow[data-relation=' + dataRelation + ']');
        
        errorMesagge.addClass('hide').html('');
        successMessage.addClass('hide').html('');
        
        var actionUrl = moderateIkasleaActionUrl + $('[name=url]').val();
        
        $.ajax({
            url: actionUrl,
            type: 'POST',
            dataType: 'json',
            data: {
                relIkaslea: dataRelation,
                moderation: instance
            },
            success: function(data) {
                
                divContainer.find('.ikasleaModerationStatus').append($('<p>').text(data.message));
                
                if(data.status) {
                    
                    var egoera = divContainer.find('.egoera');
                    
                    if (instance == 'acceptIkaslea') {
                        
                        egoera.text('onartua');
                        
                        divContainer.find('[data-action=acceptIkaslea]').addClass('hide');
                        
                    } else if (instance == 'rejectIkaslea') {
                        
                        egoera.text('ez onartua');
                        
                        divContainer.find('[data-action=rejectIkaslea]').addClass('hide');
                        
                    }
                    
                    setTimeout(function() {
                        var message = divContainer.find('.ikasleaModerationStatus p');
                        
                        message.remove();
                        
                        if (instance == 'acceptIkaslea') {
                            divContainer.find('[data-action=rejectIkaslea]').removeClass('hide');
                        } else if (instance == 'rejectIkaslea') {
                            divContainer.find('[data-action=acceptIkaslea]').removeClass('hide');
                        }
                        
                    }, 1850);
                    
                } else {
                    
                    errorMesagge.removeClass('hide');
                    errorMesagge.append('<p>' + data.message + '</p>')
                    
                    $('html, body').animate({
                        scrollTop: '50px'
                    }, 1850);
                    
                }
                
            },
            error:function(data) {
                console.error(data);
            }
        });
        
        
    };
    
    $('[data-action=acceptIkaslea]').on('click', function() {
        moderationIkasleak($(this), 'acceptIkaslea');
    });
    
    $('[data-action=rejectIkaslea]').on('click', function() {
        moderationIkasleak($(this), 'rejectIkaslea');
    });
    
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

         Req.open(
             'POST',
             uploadAvatarActionUrl + $('[name=url]').val(),
             true
         );

         Req.onload = function(Event) {
             if (Req.status == 200) {
                 
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