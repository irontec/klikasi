$(window).load(function() {
    
    $('#tab-recursos button').tooltip({
        placement: 'bottom',
    });
    
    /**
     * Js encargado, activar las apps en el formulario de Nuevo/Editar recursos
     * Cargar la información correspondiente en el formaluario de edición.
     */

    var baseUrl = $('base').attr('href');

    $('input#titulua').on('keyup', function(event) {
        console.info('check new url');
    });

    /**
     * Selector categoría
     */
    $('#kategoriak').select2({
        placeholder: 'Kategoriak'
    });
    
    $('#kanpaina').select2({
        placeholder: 'Kanpaina'
    });

    /**
     * Crea el Slider de edad
     */
    $('#adina').slider({
        tooltip: 'hide'
    }).on('slide', function(ev){

        var element = $(this);
        var value = element.val();
        changeAdina(value);
    });

    /**
     * Cargar la infomación del slider
     */
    if ($('#adina').attr('data-selected') != undefined) {

        var adinaValue = $('#adina').val();
        $('#adina').val(adinaValue);
        changeAdina(adinaValue);
    }

    function changeAdina(adinaValue) {

        var values = adinaValue.split(',');
        var container = $('div.adina');

        if (values[0] == '') {
            container.find('.min-years').text(10);
        } else {
            container.find('.min-years').text(values[0]);
        }

        if (values[1] == '') {
            container.find('.max-years').text(45);
        } else {
            container.find('.max-years').text(values[1]);
        }
    }

    /**
     * Buscar y selecciona colaboradores.
     */
    var erabiltzaileaIrudia = baseUrl + 'multimedia/erabiltzaile-irudia-view/irudia/';
    var searchErabiltzailea = baseUrl + 'json/kolaboratzaileak?format=json';
    var searchErabiltzaileaArray = baseUrl + 'json/kolaboratzaileak-array?format=json';

    $('#beste-egile').select2({
        placeholder: 'Beste egileen izenak',
        minimumInputLength: 3,
        multiple: true,
        formatNoMatches: 'Ez dago emaitzarik',
        formatSearching: 'Bilatzen',
        formatInputTooShort: 'Gutxienez hiru karaktere',
        ajax: {
            url: searchErabiltzailea,
            dataType: 'json',
            data: function (valueSearch) {
                return {
                    erabiltzaileak: valueSearch,
                };
            },
            results: function (data) {
                return {results: data.data};
            }
        },
        formatResult: function(data) {
            var multimediaUrl = erabiltzaileaIrudia + data.id;
            var completName = data.izena + ' ' + data.abizena + ' ' + data.abizena2;
            //return '<img class="img-circle" style="width: 22px;" src="' + multimediaUrl + '" /> ' + completName;
            return completName;

        },
        formatSelection: function(data) {
            var multimediaUrl = erabiltzaileaIrudia + data.id;
            var completName = data.izena + ' ' + data.abizena + ' ' + data.abizena2;
          //return '<img class="img-circle" style="width: 22px;" src="' + multimediaUrl + '" /> ' + completName;
            return completName;
        }
    });

    /**
     * Carga los colaboradores actuales
     */
    if ($('#beste-egile').attr('data-selected') != undefined) {
        var values = $('#beste-egile').attr('data-selected');

        $.ajax({
            type: 'POST',
            url: searchErabiltzaileaArray,
            data: {
                erabiltzaileak: values
            },
            success: function(data, textStatus) {
                if (textStatus) {

                    var results = data.data;

                    $('#beste-egile').select2('data', results)

                }
            }
        });

    }

    /**
     * Busca y selecciona etiquetas
     */
    $.post(
        baseUrl + 'json/etiketak?format=json',
        function(data, textStatus) {
            if (textStatus) {
                var results = data.data;

                $('#etiketak').select2({
                    placeholder: 'Etiketak',
                    tokenSeparators: [",", " "],
                    multiple: true,
                    tags: results,
                    formatResult: function(data) {
                        return data.text;
                    },
                    formatSelection: function(data) {
                        return data.text;
                    }
                });

                if ($('#etiketak').attr('data-selected') != undefined) {

                    var etiketak = $('#etiketak').attr('data-selected');
                    $('#etiketak').select2('val', new Array(etiketak));
                }
            }

    }, 'json');

    /**
     * Selecciones actuales
     */
    if ($('#maila').attr('data-selected') != undefined) {
        $('#maila').val($('#maila').attr('data-selected'));
    }

    if ($('#kategoriak').attr('data-selected') != undefined) {
        $('#kategoriak').val($('#kategoriak').attr('data-selected'));
    }

    if ($('#eskola').attr('data-selected') != undefined) {
        $('#eskola').val($('#eskola').attr('data-selected'));
    }

    //Baliabideak Mikel
    $("div.form-balibideak button.remove").on("click", function () {
       $(this).parents("div.item:eq(0)").remove();
    });

    $("div.form-balibideak span.balibidea-submit button[type=submit]").on("click", function (e) {

        e.preventDefault();

        var contxt = $(this).parents(".balibidea-submit:eq(0)");
        var baliabideaInput = contxt.find("input");
        var baliabidea = baliabideaInput.val();
        var link = null;

        if (baliabidea.length == 0 || baliabidea.match("[a-zA-Z]+") == null) {
            console.log("nothing to do here");
            return;
        }

        var nakedUrl = null;
        var datuak = baliabideaInput.data();
        datuak.url = baliabideaInput.val();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: baseUrl + 'edukiak-igo/render',
            data: datuak,
            async: false,
            success: function(data, textStatus) {

                if (textStatus) {

                    if (!data.url) {
                        return;
                    }

                    nakedUrl = data.url
                    if (data.embed) {
                        baliabidea = $(data.embed);    
                    } else {
                        baliabidea = $(data.url);
                    }

                    if (baliabideaInput.data("success")) {

                        var functionName = baliabideaInput.data("trigger");

                        if (!window[functionName]) {
                            var str = '<script type="text/javascript" async src="'+ baliabideaInput.data("success") +'" data-pin-build="doBuild"></script>';
                            $("head").append($(str));
                        } else {
                            setTimeout(function () {window[functionName]();} , 500);
                        }   
                    }


                } else {
                    baliabidea = null;
                    nakedUrl = null;
                }
            }
        });

        baliabideaInput.val("");
        if (nakedUrl && baliabidea != null && baliabidea != '' && baliabidea.length > 0) {

            if(baliabideaInput.data("filter")) {
                baliabidea = $(baliabidea).filter(baliabideaInput.data("filter"));
            }

            var esqueleton = $("#itemEsqueleton").clone(true);
            esqueleton.removeAttr("id");

            var esqueletonInputFld = esqueleton.find("input[type=hidden]");

            if (nakedUrl) {
                esqueletonInputFld.prop("value", $("<div />").append(nakedUrl).html());
            } else {
                esqueletonInputFld.prop("value", $("<div />").append(baliabidea).html());
            }

            esqueletonInputFld.prop("name", baliabideaInput.data("name") + "_" + baliabideaInput.data("type") + "[]");

            esqueleton.find("figure:eq(0)").append(baliabidea);
            esqueleton.show();

            $(contxt.parent()).append(esqueleton);

        } else {

            
            baliabideaInput.css({"border":"1px solid red"});
            setTimeout(function() {
                console.log("timeout");
                $(baliabideaInput).css({"border":"medium none"});
            }, 2000);
            console.log("invalid asset");
            
        }
    });

    var errorMesagge = $('#edukiak-errors');
    var successMessage = $('#edukiak-success');

    $('[data-toggle=tab]').on('click', function() {
        errorMesagge.addClass('hide').html('');
        successMessage.addClass('hide').html('');
    });

    /**
     * Submit form
     */
    $('form.edukiak-igo').on('submit', function(event) {
        event.preventDefault();

        if (!$('[name=acceptConditions]').prop('checked')) {

            $('[name=acceptConditions]')
                .parents('label')
                .append(
                    $('<span>')
                        .addClass('msg')
                        .addClass('error')
                        .addClass('msgErrorCheck')
                        .text('Zerbitzu baldintzak onartu')
                );

            return;
        } else {
            $('.msgErrorCheck').remove();
        }

        var edukiaId = $('[name=edukia-id]').val();

        if (edukiaId != undefined) {
            var ajaxUrlCheck = baseUrl + '/edukiak-administrazioan?edukia=' + $('#disabledInput').val();
            var isAdministrazioan = true;
        } else {
            var ajaxUrlCheck = baseUrl + '/edukiak-igo';
            var isAdministrazioan = false;
        }

        var form = this;

        $('.has-error').find('span.msg.error').remove();
        $('.has-error').removeClass('has-error');

        $.ajax({
            url: ajaxUrlCheck,
            type: 'POST',
            dataType: 'json',
            data: $('form.edukiak-igo').serializeArray(),
            success: function(data) {

                successMessage.addClass('hide').html('');
                errorMesagge.addClass('hide').html('');

                if(data.status === true) {

                    if (isAdministrazioan === false ) {
                        window.location = data.newEdukia;
                    } else {
                        
                        successMessage
                            .removeClass('hide')
                            .append(
                                $('<p>').text(data.message)
                            ).append(
                                $('<a>').text(data.title).attr('href', data.href)
                            );
                    }

                } else {

                    errorMesagge.removeClass('hide');
                    $.each(data.errors, function(key, val) {
                        $('#' + key)
                            .parents('.element-group')
                            .addClass('has-error')
                            .append(
                                $('<span>')
                                .addClass('msg')
                                .addClass('error')
                                .text(val)
                            );

                        errorMesagge
                            .append(
                                $('<p>').text(val)
                            );

                    });
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

        if (count > 140) {
            $('.alert-countCharactes').removeClass('hide');
        } else {
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
     * Laguntzaileak
     */
    var moderationLaguntzaileak = function(element, instance) {
        var dataRelation = element.attr('data-relation');
        var divContainer = $('.notificationCustomRow[data-relation=' + dataRelation + ']');
        
        errorMesagge.addClass('hide').html('');
        successMessage.addClass('hide').html('');
        
        var actionUrl = baseUrl + 'edukiak-administrazioan/moderate-laguntzailea/edukia/' + $('#tab-recursos').attr('data-url');
        
        $.ajax({
            url: actionUrl,
            type: 'POST',
            dataType: 'json',
            data: {
                relLaguntzailea: dataRelation,
                moderation: instance
            },
            success: function(data) {
                
                divContainer.find('.laguntzaileakModerationStatus').append($('<p>').text(data.message));
                
                if(data.status) {
                    
                    var egoera = divContainer.find('.egoera');
                    
                    if (instance == 'acceptLaguntzaileak') {
                        
                        egoera.text('onartua');
                        
                        divContainer.find('[data-action=acceptLaguntzaileak]').addClass('hide');
                        
                    } else if (instance == 'rejectLaguntzaileak') {
                        
                        egoera.text('ez onartua');
                        
                        divContainer.find('[data-action=rejectLaguntzaileak]').addClass('hide');
                        
                    }
                    
                    setTimeout(function() {
                        var message = divContainer.find('.laguntzaileakModerationStatus p');
                        
                        message.remove();
                        
                        if (instance == 'acceptLaguntzaileak') {
                            divContainer.find('[data-action=rejectLaguntzaileak]').removeClass('hide');
                        } else if (instance == 'rejectLaguntzaileak') {
                            divContainer.find('[data-action=acceptLaguntzaileak]').removeClass('hide');
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
    
    $('[data-action=acceptLaguntzaileak]').on('click', function() {
        moderationLaguntzaileak($(this), 'acceptLaguntzaileak');
    });
    
    $('[data-action=rejectLaguntzaileak]').on('click', function() {
        moderationLaguntzaileak($(this), 'rejectLaguntzaileak');
    });
    
    /**
     * Hobekuntzak
     */
    
    $('[data-action=replyHobekuntzak]').on('click', function() {
        var element = $(this);
        
        var dataRelation = element.attr('data-relation');
        var divContainer = $('.notificationCustomRow[data-relation=' + dataRelation + ']');
        
        $('#sendMessage-dialog').find('em').text(divContainer.find('a').text());
        $('#sendMessage-dialog [name=hobekuntzakId]').val(dataRelation);
        
        $('#sendMessage-dialog').modal({
            show: true,
            backdrop: 'static',
            keyboard: false,
        });
        
    });
    
    var divDanger = $('#sendMessage-dialog .alert-danger');
    var divSuccess = $('#sendMessage-dialog .alert-success');
    var dialogTextarea = $('#sendMessage-dialog textarea');
    var dialogButtonSend = $('#sendMessage-dialog [data-action=send]');
    var dialogButtonClosed = $('#sendMessage-dialog [data-action=closed]');
    
    dialogButtonSend.on('click', function(event) {
        event.preventDefault();
        
        divDanger.addClass('hide').html('');
        divSuccess.addClass('hide').html('');
        
        var mezua = dialogTextarea.val();
        if (mezua.trim() == '') {
            
            divDanger.append($('<p>').text('Mezua betetzea beharrezkoa da'));
            divDanger.removeClass('hide');
            
            return false;
        }
        
        var formData = $('#sendMessage-dialog form').serializeArray();
        
        dialogTextarea.prop('disabled', true);
        dialogButtonClosed.prop('disabled', true);
        dialogButtonSend.prop('disabled', true);
        
        var actionUrl = baseUrl + 'edukiak-administrazioan/hobekuntzak/edukia/' + $('#tab-recursos').attr('data-url');
        
        $.ajax({
            url: actionUrl,
            type: 'POST',
            dataType: 'json',
            data: formData,
            success: function(data) {
                
                if (data.status) {
                    
                    divSuccess.append($('<p>').text(data.message));
                    divSuccess.removeClass('hide');
                    
                    dialogButtonClosed.prop('disabled', false);
                    
                } else {
                    
                    divDanger.append($('<p>').text(data.message));
                    divDanger.removeClass('hide');
                    
                    dialogTextarea.prop('disabled', false);
                    dialogButtonClosed.prop('disabled', false);
                    dialogButtonSend.prop('disabled', false);
                    
                }
                
            },
            error:function(data) {
                console.error(data);
            }
        });
        
    });
    
    dialogButtonClosed.on('click', function(event) {
        event.preventDefault();
        
        divDanger.addClass('hide').html('');
        divSuccess.addClass('hide').html('');
        
        dialogTextarea.val('');
        dialogTextarea.prop('disabled', false);
        
        $('#sendMessage-dialog [name=hobekuntzakId]').val('');
        $('#sendMessage-dialog em').text('');
        
        dialogButtonClosed.prop('disabled', false);
        dialogButtonSend.prop('disabled', false);
        
        $('#sendMessage-dialog').modal('hide');
        
    });
    
    /**
     * Delete Hobekuntzak
     */
    $('[data-action=deleteHobekuntzak]').on('click', function() {
        var element = $(this);
        
        var dataRelation = element.attr('data-relation');
        var divContainer = $('.notificationCustomRow[data-relation=' + dataRelation + ']');
        
        divContainer.find('.hobekuntzakModerationStatus').html('');
        
        var actionUrl = baseUrl + 'edukiak-administrazioan/hobekuntzak-delete/edukia/' + $('#tab-recursos').attr('data-url');
        
        $.ajax({
            url: actionUrl,
            type: 'POST',
            dataType: 'json',
            data: {
                hobekuntzak: dataRelation
            },
            success: function(data) {
                
                if (data.status) {
                    
                    divContainer.html($('<p>').addClass('text-danger').text(data.message));
                    
                    setTimeout(function() {
                        divContainer.slideUp('slow', function() {
                            divContainer.remove();
                        });
                    }, 3000);
                    
                } else {
                    divContainer.find('.hobekuntzakModerationStatus').append($('<p>').addClass('text-danger').text(data.message));
                    
                }
                
            },
            error:function(data) {
                console.error(data);
            }
        });
        
    });
    
    /**
     * Eliminar Recurso.
     */
    $('#showDeletePost').on('click', function() {
        $('#showDeletePost').addClass('hide');
        $('#confirmationDeletePostMessage').removeClass('hide');
        
    });
    
    $('#confirmationDeletePostButton').on('click', function() {
        
        var currentEdukia = $('[name=edukia-id]').val();
        var deleteUrl = baseUrl + 'edukiak-administrazioan/delete-edukia/edukia/' + $('#tab-recursos').attr('data-url');
        
        $.ajax({
            url: deleteUrl,
            type: 'POST',
            dataType: 'json',
            data: {
                edukiaId: currentEdukia
            },
            success: function(data) {
                
                window.location = baseUrl + 'edukiak';
                
            },
            error:function(data) {
                console.error(data);
            }
        });
        
    });

    $('#datuak-utzi').on('click', function(event) {
        $('#edukia-url-view').get(0).click();
    });
});