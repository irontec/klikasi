(function($) {
    $(document).ready(function() {

        /**
         * Load info "Datu pertsonalak"
         */
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
        var maxDateStart = new Date(now.getFullYear() - 2, now.getMonth(), now.getDate(), 0, 0, 0, 0);

        var data = $('#jaiotzeData input').attr('value');

        $('#jaiotzeData input').datepicker({
            language: "eu",
            format: "yyyy-mm-dd",
            autoclose: "true",
            startDate: "1910-01-01",
            endDate: maxDateStart,
            startView: 2
        });

        var errorMesagge = $('#errorMesagge');
        var successMessage = $('#successMessage');

        var baseUrl = $('base').attr('href');
        var erabiltzaileaActionUrl = baseUrl + 'egileak/erabiltzailea/';
        var jakinarazpenakActionUrl = baseUrl + 'egileak/jakinarazpenak/';
        var addRelIkastegiakActionUrl = baseUrl + 'egileak/add-rel-ikastegia/';
        var nireIkastegiakActionUrl = baseUrl + 'egileak/nire-ikastegiak/';
        var nireIrakasleakActionUrl = baseUrl + 'egileak/nire-irakasleak/';
        var nireIkasleakActionUrl = baseUrl + 'egileak/nire-ikasleak/';
        var uploadAvatarActionUrl = baseUrl + 'egileak/upload-custom-avatar';
        var socialNetworksActionUrl = baseUrl + 'egileak/social-networks/';

        $('[data-toggle=tab]').on('click', function() {

            errorMesagge.addClass('hide').html('');
            successMessage.addClass('hide').html('');

        });

        $('#erabiltzailea-form').on('submit', function(event) {
            event.preventDefault();

            var dataForm = $('#erabiltzailea-form').serializeArray();

            errorMesagge.addClass('hide').html('');
            successMessage.addClass('hide').html('');

            $.each($('.has-error'), function(key, val) {
                $(val).removeClass('has-error');
            });
            
            $.ajax({
                url: erabiltzaileaActionUrl,
                type: 'POST',
                dataType: 'json',
                data: dataForm,
                success: function(data) {

                    var title = $('<strong>').text('Datu pertsonalak');
                    var message = $('<p>').text(data.message);

                    if (data.status) {

                        successMessage.removeClass('hide');
                        successMessage.html($('<p>').html(title).append(message));
                        
                    } else {

                        var errors = data.errors;

                        errorMesagge.removeClass('hide');
                        var errorContent = $('<p>').html(title);

                        $.each(errors, function(key, val) {
                            $('#' + key).parents('.form-group').addClass('has-error');
                            errorContent.append($('<p>').html(val));
                        });

                        errorMesagge.html(errorContent);
                    }
                    
                    $('html, body').animate({
                        scrollTop: '50px'
                    }, 1850);

                },
                error:function(data) {
                    console.error(data);
                }
            });

        });//#erabiltzailea-form

        $('#jakinarazpenak-form').on('submit', function(event) {
            event.preventDefault();

            var dataForm = $('#jakinarazpenak-form').serializeArray();

            $.ajax({
                url: jakinarazpenakActionUrl,
                type: 'POST',
                dataType: 'json',
                data: dataForm,
                success: function(data) {

                    var title = $('<strong>').text('Notifikazio');
                    var message = $('<p>').text(data.message);

                    if (data.status) {

                        successMessage.removeClass('hide');
                        successMessage.html($('<p>').html(title).append(message));

                    } else {

                        errorMesagge.removeClass('hide');
                        errorMesagge.html($('<p>').html(title).append(message));

                    }
                    
                    $('html, body').animate({
                        scrollTop: '50px'
                    }, 1850);

                },
                error:function(data) {
                    console.error(data);
                }
            });

        });//#jakinarazpenak-form

        $('#addRelIkastegia-form').on('submit', function(event) {
            event.preventDefault();

            var select = $('#addRelIkastegia-form select');
            var ikastegiaId = select.val();

            var dataForm = {
                ikastegia: ikastegiaId
            };

            $.ajax({
                url: addRelIkastegiakActionUrl,
                type: 'POST',
                dataType: 'json',
                data: dataForm,
                success: function(data) {

                    var title = $('<strong>').text('Notifikazio');
                    var message = $('<p>').text(data.message);

                    if (data.status) {

                        select.find('option[value=' + ikastegiaId + ']').remove();

                        if (select.find('option').length == 0) {

                            $('#addRelIkastegia-form').remove();
                        }

                        $('.emptyTR').remove();

                        $('#nireIkastegiakTable tbody').append(
                            $('<tr>').append(
                                $('<td>').html(
                                    $('<a>').text(data.name).attr('href', data.url).attr('title', data.name).append('<i>').addClass('fa fa-external-link')
                                )
                            ).append(
                                $('<td>').text('Bai')
                            ).append(
                                $('<td>').text('Ez')
                            ).append(
                                $('<td>').text('Ez')
                            ).append(
                                $('<td>').text('Zain')
                            ).append(
                                $('<td>').html(
                                    $('<button>')
                                        .text('Eskaera baztertu')
                                        .addClass('btn')
                                        .addClass('btn-warning')
                                        .addClass('cancelPetition')
                                        .attr('data-ikastegia', data.ikastegiaId)
                                )
                            )
                        );

                        successMessage.removeClass('hide');
                        successMessage.html($('<p>').html(title).append(message));

                    } else {

                        errorMesagge.removeClass('hide');
                        errorMesagge.html($('<p>').html(title).append(message));

                    }

                },
                error:function(data) {
                    console.error(data);
                }
            });

        });//#addRelIkastegia-form

        $('#nireIkastegiakTable button').on('click', function(event) {
            event.preventDefault();

            var element = $(this);

            var actionIkastegia = 'leaveIkastegia';

            if (element.hasClass('cancelPetition')) {
                actionIkastegia = 'cancelPetition';
            }

            var dataForm = {
                ikastegia: element.attr('data-ikastegia'),
                aukerak: actionIkastegia
            };

            $.ajax({
                url: nireIkastegiakActionUrl,
                type: 'POST',
                dataType: 'json',
                data: dataForm,
                success: function(data) {

                    var title = $('<strong>').text('Notifikazio');
                    var message = $('<p>').text(data.message);

                    if (data.status) {

                        /*element
                            .parents('tr')
                            .html(
                                $('<td colspan="6" class="alert alert-danger">')
                                    .text(data.message)
                            );*/

                        element.parents('tr:eq(0)').remove();

                        successMessage.removeClass('hide');
                        successMessage.html($('<p>').html(title).append(message));

                    } else {

                        errorMesagge.removeClass('hide');
                        errorMesagge.html($('<p>').html(title).append(message));

                    }

                },
                error:function(data) {
                    console.error(data);
                }
            });

        });//#nireIkastegiakTable button

        $('#nireIrakasleak .cancelPetition').on('click',function(event) {
            event.preventDefault();

            errorMesagge.addClass('hide').html('');
            successMessage.addClass('hide').html('');

            var element = $(this);
            var action = element.attr('data-action');
            var irakaslea = element.attr('data-irakaslea');
            var trElement = $('td[data-irakaslea=' + irakaslea + ']').parents('tr');

            var dataForm = {
                actionForm: action,
                irakasleaRelId: irakaslea
            };

            $.ajax({
                url: nireIrakasleakActionUrl,
                type: 'POST',
                dataType: 'json',
                data: dataForm,
                success: function(data) {

                    var title = $('<strong>').text('Nire Irakaslea');
                    var message = $('<p>').text(data.message);

                    if (data.status) {

                        trElement
                            .html(
                                $('<td colspan="4" class="alert alert-danger">')
                                    .text(data.message)
                            );

                        successMessage.removeClass('hide');
                        successMessage.html($('<p>').html(title).append(message));

                    } else {

                        errorMesagge.removeClass('hide');
                        errorMesagge.html($('<p>').html(title).append(message));

                    }

                },
                error:function(data) {
                    console.error(data);
                }
            });

        });//#nireIrakasleak .cancelPetition

        $('#nireIrakasleak #addIrakasleak').on('click', function(event) {
            event.preventDefault();

            errorMesagge.addClass('hide').html('');
            successMessage.addClass('hide').html('');

            var element = $(this);
            var selectForm = $('#addIrakasleak-form select');
            var value = selectForm.val();

            var dataForm = {
                actionForm: 'addIrakasleak',
                newRelIrakaslea: value
            };

            $.ajax({
                url: nireIrakasleakActionUrl,
                type: 'POST',
                dataType: 'json',
                data: dataForm,
                success: function(data) {

                    var title = $('<strong>').text('Nire Irakaslea');
                    var message = $('<p>').text(data.message);

                    if (data.status) {

                        selectForm.find('option[value=' + value + ']').remove();

                        if (selectForm.find('option').length == 0) {
                            $('#addIrakasleak-form').remove();
                        }

                        successMessage.removeClass('hide');
                        successMessage.html($('<p>').html(title).append(message));

                    } else {

                        errorMesagge.removeClass('hide');
                        errorMesagge.html($('<p>').html(title).append(message));

                    }

                },
                error:function(data) {
                    console.error(data);
                }
            });

        });//#nireIrakasleak #addIrakasleak

        $('#nire-ikasle-tab button').on('click', function(event) {
            event.preventDefault();

            var element = $(this);
            var action = element.attr('data-action');
            var erabiltzailea = element.attr('data-erabiltzailea');
            var ikastegia = element.attr('data-ikastegia');

            var dataForm = {
                    relAction: action,
                    erabiltzaileaId: erabiltzailea,
                    ikastegiaId: ikastegia
            };

            $.ajax({
                url: nireIkasleakActionUrl,
                type: 'POST',
                dataType: 'json',
                data: dataForm,
                success: function(data) {

                    var title = $('<strong>').text('Nire Ikaslea');
                    var message = $('<p>').text(data.message);

                    if (data.status) {

                        successMessage.removeClass('hide');
                        successMessage.html($('<p>').html(title).append(message));

                        var currentTable = $('#nire-ikasle-tab');

                        var acceptButton = currentTable.find('button[data-erabiltzailea=' + erabiltzailea + '][data-action=accept]');
                        var rejectButton = currentTable.find('button[data-erabiltzailea=' + erabiltzailea + '][data-action=reject]');

                        var status = '';

                        if (action == 'accept') {

                            acceptButton.addClass('hide');
                            rejectButton.removeClass('hide');

                            var status = 'onartua';

                        } else if (action == 'reject') {

                            rejectButton.addClass('hide');
                            acceptButton.removeClass('hide');

                            var status = 'ez onartua';

                        }

                        currentTable.find('tr[data-erabiltzailea=' + erabiltzailea + ']').find('.egoera').text(status);

                    } else {

                        errorMesagge.removeClass('hide');
                        errorMesagge.html($('<p>').html(title).append(message));

                    }

                },
                error:function(data) {
                    console.error(data);
                }
            });

        });//#nire-ikasle-tab button
        
        /**
         * Sistema de Avatar
         */
        var typeAvatarInput = $('[name=typeAvatar]');
        var irudiaDefaultInput = $('[name=irudiaDefault]');
        
        if (typeAvatarInput.val() == 'default') {
            var currentValDefault = irudiaDefaultInput.val();
            $('[data-value=' + currentValDefault + ']').addClass('selected');
            
        } else {
            
        }
        
        $('button#avatar-show').on('click', function(event) {
            event.preventDefault();
            $('.form-group #izenaeman').removeClass('hide');
            $('button#avatar-show').addClass('hide');
            $('button#avatar-hide').removeClass('hide');
            $('#changeAvatar').val(true);
            return false;
        });
        
        $('button#avatar-hide').on('click', function(event) {
            event.preventDefault();
            $('.form-group #izenaeman').addClass('hide');
            $('button#avatar-show').removeClass('hide');
            $('button#avatar-hide').addClass('hide');
            $('#changeAvatar').val(false);
            return false;
        });
        
        $('#irudia-default span').on('click', function() {
            var element = $(this);
            
            $('#irudia-default ul').find('.selected').removeClass('selected');
            
            element.addClass('selected');
            
            var value = element.attr('data-value');
            
            typeAvatarInput.val('default');
            irudiaDefaultInput.val(value);
            
            $('#cropimage').attr('src', 'http://placehold.it/200x200');
            
        });
        
        /**
         * Avatar
         */
        
        $('#button-file-avatar').on('click', function(event) {
            event.preventDefault();
            $('#avatar').click();
            
            $('#irudia-default').find('.selected').removeClass('selected');
            
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
                 uploadAvatarActionUrl,
                 true
             );

             Req.onload = function(Event) {
                 if (Req.status == 200) {
                     
                     var uploadResult = JSON.parse(Req.responseText);
                     
                     if (uploadResult.status) {
                         
                         typeAvatarInput.val('irudia');
                         irudiaDefaultInput.val('');
                         
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
         
         /**
          * SocialNetworks
          */
         $('#bidali-socialNetworks').on('click', function(event) {
             event.preventDefault();
             
             var formData = $('#socialNetworks-form').serializeArray();
             
             $.ajax({
                 url: socialNetworksActionUrl,
                 type: 'POST',
                 dataType: 'json',
                 data: formData,
                 success: function(data) {

                     var title = $('<strong>').text('Datu pertsonalak');
                     var message = $('<p>').text(data.message);

                     if (data.status) {

                         successMessage.removeClass('hide');
                         successMessage.html($('<p>').html(title).append(message));

                     } else {

                         var errors = data.errors;

                         errorMesagge.removeClass('hide');
                         var errorContent = $('<p>').html(title);

                         $.each(errors, function(key, val) {
                             $('#' + key).parents('.form-group').addClass('has-error');
                             errorContent.append($('<p>').html(val));
                         });

                         errorMesagge.html(errorContent);
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
          * Eliminar Cuenta
          */
         
         $('#showDeleteAccount').on('click', function() {
             $('#showDeleteAccount').addClass('hide');
             $('#confirmationDeleteAccountMessage').removeClass('hide');
             
         });
         
         $('#confirmationDeleteAccountButton').on('click', function() {
             
             var deleteUrl = baseUrl + 'egileak/delete-erabiltzailea';
             
             $.ajax({
                 url: deleteUrl,
                 type: 'post',
                 datatype: 'json',
                 data: {
                     deleteAccount: true
                 },
                 success: function(data) {
                     
                     window.location = baseUrl;
                     
                 },
                 error:function(data) {
                     console.error(data);
                 }
             });
             
         });
         
         
    });
})(jQuery);