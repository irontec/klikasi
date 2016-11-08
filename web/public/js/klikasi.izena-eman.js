$(window).load(function() {

    var isMobile = window.custonScreenMatch && window.custonScreenMatch.matches;
    
    window.isotope = $('.container-filter').isotope({
        itemSelector: '.resumen-ficha',
        getSortData: {
        },
        sortAscending: true,
        isOriginLeft: !isMobile
    });
    
});

(function($) {
    $(document).ready(function() {

        var baseUrl = $('base').attr('href');
        var registrationUrl = baseUrl + 'izena-eman/izena-eman/format/json';
        var registrationImagenUrl = baseUrl + 'izena-eman/izena-eman-irudia/format/json';
        var registrationFinishUrl = baseUrl + 'izena-eman/izena-eman-finish/format/json';
        var searchIrakasleak = baseUrl + 'json/search-irakasleak/format/json';
        var erabiltzaileIzenaExistUrl = baseUrl + 'izena-eman/erabiltzaile-izena-exist';

        /**
         * Carga el modal, de registro
         */
        var izenaEmanShow = $('body').attr('data-izenaEmanShow');

        if (izenaEmanShow == 'true') {
            if ($('.js-home-batu').length != 0) {
                $('#tab-izenaeman').modal({
                    show: true,
                    backdrop: 'static',
                    keyboard: false,
                });
            }
        }

        /**
         * Carga el modal de resgistro, desde el 4º paso.
         */
        var ikusiErabiltzailea = $('#ikusi-erabiltzailea').attr('data-izena');

        if (ikusiErabiltzailea != undefined) {
            if (ikusiErabiltzailea === 'true') {

                $('#li-izenaeman1').parents('li').removeClass('active');
                $('#li-izenaeman4').parents('li').addClass('active')
                $('#izenaeman1').removeClass('active');
                $('#izenaeman4').addClass('active');

                $('#tab-izenaeman').modal({
                    show: true,
                    backdrop: 'static',
                    keyboard: false,
                });

            }
        }
        
        /**
         * Configuración inicial de datepicker.
         * Para poder registrarse tiene que tener 6 años.
         */
        var nowDate = new Date();
        nowDate.setFullYear(nowDate.getFullYear()-6);
        
        $('#izenaeman-edad').datepicker({
            language: "eu",
            format: "yyyy-mm-dd",
            autoclose: "true",
            endDate: nowDate,
            startView: 2,
        }).on('show', function() {
            $('.datepicker.datepicker-dropdown').css("z-index", 10060);
        });

        $('.js-home-batu').on('click', function() {
            $('#tab-izenaeman').modal({
                show: true,
                backdrop: 'static',
                keyboard: false,
            });
        });
        
        /**
         * Comprueba que el nombre de usuario no exista.
         */
        $('#form-izenaeman1 #user-name').on('keyup', function() {
            
            var element = $(this);
            var userNameInput = $('#form-izenaeman1 #user-name');
            var parentInput = userNameInput.parents('.input-group');
            
            $.ajax({
                url: erabiltzaileIzenaExistUrl,
                type: 'POST',
                dataType: 'json',
                data: {
                    userName: element.val()
                },
                success: function(data) {
                    
                    parentInput.removeClass('has-error');
                    parentInput.find('span').remove();
                    
                    if (data.status) {
                        
                        parentInput.addClass('has-error');
                        
                        parentInput.append(
                            $('<span>').attr('class', 'msg error').text(data.message)
                        );
                        
                    } else {
                        
                        parentInput.removeClass('has-error');
                        parentInput.find('span').remove();
                        
                    }
                    
                },
                error:function(data) {
                    console.error(data);
                }
            });
            
        });
        
        /**
         * Puntuación de password, para saver que fiabilidad.
         */
        var scorePassword = function (pass) {
            var score = 0;
            if (!pass)
                return score;

            var letters = new Object();
            for (var i=0; i<pass.length; i++) {
                letters[pass[i]] = (letters[pass[i]] || 0) + 1;
                score += 5.0 / letters[pass[i]];
            }

            var variations = {
                digits: /\d/.test(pass),
                lower: /[a-z]/.test(pass),
                upper: /[A-Z]/.test(pass),
                nonWords: /\W/.test(pass),
            }

            variationCount = 0;
            for (var check in variations) {
                variationCount += (variations[check] == true) ? 1 : 0;
            }
            score += (variationCount - 1) * 10;

            return parseInt(score);
        };
        
        /**
         * Progress-Bar de fiabilidad de password.
         */
        $('#form-izenaeman1 #pasahitza').on('keyup', function() {
            
            var element = $(this);
            var score = scorePassword(element.val());
            
            var strong = $('.progress .strong');
            var good = $('.progress .good');
            var weak = $('.progress .weak');
            
            if (score > 70) {
                
                weak.css('width', '35%');
                good.css('width', '35%');
                
                if (score < 100) {
                    strong.css('width', score - 70 + '%');
                } else {
                    strong.css('width', '30%');
                }
                
            } else if (score > 35) {
                weak.css('width', '35%');
                strong.css('width', '0%');
                good.css('width', score - 35 + '%');
                
            } else {
                good.css('width', '0%');
                strong.css('width', '0%');
                weak.css('width', score + '%');
                
            }
            
        });
        
        /**
         * Comprueba que el password coincide.
         */
        $('#form-izenaeman1 #reply-pasahitza').on('keyup', function() {
            
            var parentInput = $('#form-izenaeman1 #reply-pasahitza').parents('.input-group');
            var element = $(this);
            var value = element.val();
            var first = $('#form-izenaeman1 #pasahitza').val();
            
            parentInput.removeClass('has-error');
            parentInput.find('span').remove();
            
            if (first !== value) {
                parentInput.addClass('has-error');
                
                parentInput.append(
                    $('<span>').attr('class', 'msg error').text('Pasahitza ez da berdina')
                );
                
            } else {
                
                parentInput.removeClass('has-error');
                parentInput.find('span').remove();
            }
            
        });
        
        /**
         * Envia el primer formulario al servidor para que se encarge de las comprobaciones y cree al nuevo usuario
         * o como respuesta indique los errores.
         */
        $('#a-izenaeman1').on('click', function(event) {
            event.preventDefault();

            $('#errors-izenaeman1').addClass('hide');
            $('#errors-izenaeman1 p').remove();

            var dataForm = $('#form-izenaeman1 input').serializeArray();

            $('#form-izenaeman1 #user-name').prop('disabled', true);
            $('#form-izenaeman1 #email').prop('disabled', true);
            $('#form-izenaeman1 #pasahitza').prop('disabled', true);
            $('#form-izenaeman1 #izenaeman-edad input').prop('disabled', true);

            $.ajax({
                url: registrationUrl,
                type: 'POST',
                dataType: 'json',
                data: dataForm,
                success: function(data) {

                    $('#form-izenaeman1 #user-name').prop('disabled', false);
                    $('#form-izenaeman1 #email').prop('disabled', false);
                    $('#form-izenaeman1 #pasahitza').prop('disabled', false);
                    $('#form-izenaeman1 #izenaeman-edad input').prop('disabled', false);

                    if(data.status === true) {

                        $('#li-izenaeman1').parents('li').removeClass('active');
                        $('#izenaeman1').removeClass('active');

                        $('#li-izenaeman2').parents('li').addClass('active');
                        $('#izenaeman2').addClass('active');

                        $('#form-izenaeman2 #erabiltzailea-id').val(data.erabiltzailea);

                        if (!data.isSenior) {
                            $('#ikasle[type=radio]').click();
                            $('#ikasle[type=radio]').parent('label').addClass('hide');
                            $('#Irakaslea[type=radio]').parent('label').addClass('hide');
                            $('#otros[type=radio]').parent('label').addClass('hide');
                        }

                    } else {

                        $('#errors-izenaeman1').removeClass('hide');

                        $.each(data.errors, function(key, val) {
                            $('#errors-izenaeman1').append('<p>' + val + '</p>')
                        });

                    }
                },
                error:function(data) {
                    console.error(data);
                }
            });

        });//#a-izenaeman1

        /**
         * Envia los datos del segundo formulario al servidor,
         * para comprobar que todo esta bien y envia un email de validación.
         */
        $('#a-izenaeman2').on('click', function(event) {
            event.preventDefault();
            
            var currentForm = $('#form-izenaeman2');
            var dataForm = currentForm.serializeArray();
            
            currentForm.find('.has-error').find('span').remove();
            currentForm.find('.has-error').removeClass('has-error');
            $('#errors-izenaeman2').addClass('hide');
            $('#errors-izenaeman2 p').remove();
            
            
            var izenaInput = currentForm.find('#izena');
            var abizenaInput = currentForm.find('#abizena');
            var abizenaSecondInput = currentForm.find('#abizena-second');
            var deskribapenaTextarea = currentForm.find('#deskribapena');
            var profilaRadio = currentForm.find('[name=profila]');
            
            izenaInput.prop('disabled', true);
            abizenaInput.prop('disabled', true);
            abizenaSecondInput.prop('disabled', true);
            deskribapenaTextarea.prop('disabled', true);
            profilaRadio.prop('disabled', true);
            
            $.ajax({
                url: registrationImagenUrl,
                type: 'POST',
                dataType: 'json',
                data: dataForm,
                success: function(data) {

                    izenaInput.prop('disabled', false);
                    abizenaInput.prop('disabled', false);
                    abizenaSecondInput.prop('disabled', false);
                    deskribapenaTextarea.prop('disabled', false);
                    profilaRadio.prop('disabled', false);
                    
                    if(data.status === true) {

                        $('#li-izenaeman2').parents('li').removeClass('active');
                        $('#izenaeman2').removeClass('active');

                        $('#li-izenaeman3').parents('li').addClass('active');
                        $('#izenaeman3').addClass('active');

                    } else {

                        $('#errors-izenaeman2').removeClass('hide');

                        $.each(data.errors, function(key, val) {
                            
                            if (key == 0) {
                                $('#errors-izenaeman2').append('<p>' + val + '</p>')
                                
                            } else if (key == 'profila') {
                                var parent = profilaRadio.parents('.input-group');
                                parent.addClass('has-error');
                                parent.append(
                                    $('<span>').addClass('msg').addClass('error').text(val)
                                );
                            } else {
                                
                                var parent = $('#' + key).parents('.input-group');
                                parent.addClass('has-error');
                                parent.append(
                                    $('<span>').addClass('msg').addClass('error').text(val)
                                );
                                
                            }
                            
                        });

                    }
                },
                error:function(data) {
                    console.error(data);
                }
            });

        });//#a-izenaeman2

        $('#a-izenaeman5').on('click', function(event) {
            event.preventDefault();

            $('#li-izenaeman4').parents('li').removeClass('active');
            $('#izenaeman4').removeClass('active');

            $('#li-izenaeman5').parents('li').addClass('active');
            $('#izenaeman5').addClass('active');

        });//#a-izenaeman4
        
        /**
         * Segun el Ikastegia seleccionado, lista a los profesores existentes.
         */
        $('#ikastegiak-select').on('change', function() {

            var value = $(this).val();
            var irakasleakContent = $('#irakasleak-content');
            var irakasleakLoading = $('#irakasleak-loading');
            var irakasleakSelect = $('#irakasleak-select');

            if (value == 'new') {

                irakasleakContent.addClass('hide');
                irakasleakLoading.addClass('hide');

            } else {

                irakasleakContent.addClass('hide');
                irakasleakLoading.removeClass('hide');

                $.ajax({
                    url: searchIrakasleak,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        irakasleak: value
                    },
                    success: function(data) {

                        irakasleakContent.removeClass('hide');
                        irakasleakLoading.addClass('hide');

                        irakasleakSelect.find('option').remove();

                        if (data.data.length > 0) {

                            $.each(data.data, function(key, val) {
                                irakasleakSelect.append($('<option>', {
                                    value: val.id,
                                    text: val.izena
                                }));
                            });

                        } else {

                            irakasleakSelect.append($('<option>', {
                                value: 'empty',
                                text: 'Irakaslerik ez'
                            }));

                        }
                    },
                    error:function(data) {
                        console.error(data);
                    }
                });

            }

        });
        
        $('#ikastegiak-select').on('change', function() {
            
            var value = $(this).val();
            
            if (value == 'new') {
                $('#izena-eman-finish').text('Ikastegi berria proposatu')
            } else {
                $('#izena-eman-finish').text('Amaitu')
            }
            
        });
        
        /**
         * Envia el ultimo paso, guardando el Avatar seleccionado y creando las relaciones con el Ikastegia,
         * o redireccionando al formulario de nuevo Ikastegia.
         */
        $('#izena-eman-finish').on('click', function(event) {
            event.preventDefault();

            $('#errors-izenaeman5').addClass('hide');
            $('#errors-izenaeman5 p').remove();

            var dataForm = $('#form-izenaeman5').serializeArray();

            $.ajax({
                url: registrationFinishUrl,
                type: 'POST',
                dataType: 'json',
                data: dataForm,
                success: function(data) {

                    if(data.status === true) {

                        window.location = baseUrl + data.url;

                    } else {

                        $('#errors-izenaeman5').removeClass('hide');

                        $.each(data.errors, function(key, val) {
                            $('#errors-izenaeman5').append('<p>' + val + '</p>')
                        });

                    }
                },
                error:function(data) {
                    console.error(data);
                }
            });

        });//#izena-eman-finish
        
        /**
         * Sistema de Avatar
         */
        var typeAvatarInput = $('[name=typeAvatar]');
        var irudiaDefaultInput = $('[name=irudiaDefault]');
        
        irudiaDefaultInput.val('naranja');
        $('[data-value=naranja]').addClass('selected');
        
        $('#irudia-default span').on('click', function() {
            
            var element = $(this);
            
            $('#irudia-default').find('.selected').removeClass('selected');
            
            element.addClass('selected');
            
            var value = element.attr('data-value');
            
            typeAvatarInput.val('default');
            irudiaDefaultInput.val(value);
            
            $('#cropimage').attr('src', 'http://placehold.it/200x200');
            
            $('#results-avatar input').each(function(key, val) {
                $(val).val(0)
            });
            
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
            
            if (! $.fn.cropbox) {
                return;
            }

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
             
             var uploadAvatarActionUrl = baseUrl + 'egileak/upload-custom-avatar';
             
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

    });
})(jQuery);