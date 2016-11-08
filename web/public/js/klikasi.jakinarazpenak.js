(function($) {
    $(document).ready(function() {
        
        $('#tab-recursos button').tooltip({
            placement: 'bottom',
        });
        
        var baseUrl = $('base').attr('href');
        var jakinarazpenakActionUrl = baseUrl + 'jakinarazpenak';
        var jakinarazpenaKexaActionUrl = baseUrl + 'json/jakinarazpena-kexa/format/json';
        var jakinarazpenaMezuakActionUrl = baseUrl + 'jakinarazpenak/mezuak';
        var jakinarazpenakLockedActionUrl = baseUrl + 'jakinarazpenak/locked';
        
        var closedSendMessage = function() {
            
            $('#jakinarazpenakDialog .modal-header em').text('');
            $('.kexa-text').text('');
            $('.kexa-text')
                .parents('.form-group')
                .find('a')
                .remove();
            
            $('#jakinarazpenakId').val('');
            $('#erabiltzaileaPosta').val('');
            $('.help-block').addClass('hide');
            $('#jakinarazpenakDialog').modal('hide');
            $('#jakinarazpenakDialog #send').prop('disabled', false);
            $('#jakinarazpenakDialog textarea').val('');
            $('#jakinarazpenakDialog textarea').prop('disabled', false);
            $('.loading-sendMessage').addClass('hide');
            $('#alert.alert').addClass('hide').html('');
            
        };
        
        $('#jakinarazpenakDialog form').on('submit', function(event) {
            event.preventDefault();
            
            var textarea = $('#jakinarazpenakDialog textarea')
            var buttonSend = $('#jakinarazpenakDialog #send');
            var buttonClose = $('#jakinarazpenakDialog #close');
            var loading = $('.loading-sendMessage');
            var alertContent = $('#alert.alert');
            
            alertContent.addClass('hide').html('');
            
            if (textarea.val().trim() == '') {
                alertContent
                    .addClass('alert-warning')
                    .removeClass('hide')
                    .append(
                        $('<p>').text('Mezua betetzea beharrezkoa da')
                    );
                
                setTimeout(function() {
                    alertContent
                        .addClass('hide')
                        .removeClass('alert-warning')
                        .html('');
                }, 2500);
                
                return false;
            }
            
            var dataForm = $('#jakinarazpenakDialog form').serializeArray();

            buttonSend.prop('disabled', true);
            buttonClose.prop('disabled', true);
            loading.removeClass('hide');
            textarea.prop('disabled', true);
            
            $.ajax({
                url: jakinarazpenaMezuakActionUrl,
                type: 'POST',
                dataType: 'json',
                data: dataForm,
                success: function(data) {
                    
                    buttonClose.prop('disabled', false);
                    loading.addClass('hide');
                    
                    if (data.status === true) {
                        
                        var addClassAlert = 'alert-success';
                        
                    } else {
                        
                        var addClassAlert = 'alert-warning';
                        
                        textarea.prop('disabled', false);
                        buttonSend.prop('disabled', false);
                        
                    }
                    
                    alertContent
                        .addClass(addClassAlert)
                        .removeClass('hide')
                        .append(
                            $('<p>').text(data.message)
                        );
                    
                },
                error:function(data) {
                    alertContent
                        .addClass('alert-warning')
                            .removeClass('hide')
                            .append(
                                $('<p>').text('#404')
                            );
                    
                    textarea.prop('disabled', false);
                    buttonSend.prop('disabled', false);
                    buttonClose.prop('disabled', false);
                    loading.addClass('hide');
                    
                }
            });
            
        });
        
        $('#jakinarazpenakDialog #close').on('click', function(event) {
            event.preventDefault();
            closedSendMessage();
        });
        
        var contactPersonal = function(jakinarazpenaId) {
            
            $.ajax({
                url: jakinarazpenaKexaActionUrl,
                type: 'POST',
                dataType: 'json',
                data: {
                    jakinarazpenaKexa: jakinarazpenaId,
                    actionMezuak: 'kexa'
                },
                success: function(data) {
                    
                    if (data.status === true) {
                        
                        $('.help-block').removeClass('hide');
                        
                        $('.kexa-text').text(data.kexa);
                        
                        $('#actionInstance').val('contactPersonal');
                        
                        $('.kexa-text')
                            .parents('.form-group')
                            .append(
                                $('<a>')
                                    .attr('title', data.edukiaTitulua)
                                    .attr('href', data.edukiaUrl)
                                    .text(data.edukiaTitulua + ' ')
                                    .append(
                                        $('<i>')
                                            .addClass('fa')
                                            .addClass('fa-external-link')
                                    )
                            );
                        
                        $('#jakinarazpenakId').val(data.jakinarazpenaId);
                        $('#jakinarazpenakDialog .modal-header em').text(data.erabiltzaileaIzena);
                        $('#erabiltzaileaPosta').val(data.erabiltzaileaPosta);
                        
                        $('#jakinarazpenakDialog').modal({
                            show: true,
                            backdrop: 'static',
                            keyboard: false,
                        });
                        
                    }
                    
                },
                error:function(data) {
                    console.error(data);
                }
            });
            
        };
        
        var lockedEdukia = function(elementJakinarazpena) {
            
            var edukiaLink = $('tr[data-jakinarazpena=' + elementJakinarazpena + '] td:eq(1) a');
            var edukiaTitle = edukiaLink.text();
            
            var newLink = $('<a>').attr('href', edukiaLink.attr('href')).text(edukiaTitle);
            
            $('#blokeatutaEdukiakDialog .modal-header em').text(edukiaTitle);
            $('#blokeatutaEdukiakDialog .modal-body .link-edukia').html(newLink);
            $('#blokeatutaEdukiakDialog').attr('data-jakinarazpena', elementJakinarazpena);
            
            $('#blokeatutaEdukiakDialog').modal({
                show: true,
                backdrop: 'static',
                keyboard: false,
            });
            
        };
        
        $('#blokeatutaEdukiakDialog #locked').on('click', function(event) {
            event.preventDefault();
            
            var jakinarazpena = $('#blokeatutaEdukiakDialog').attr('data-jakinarazpena');
            
            var dataForm = {
                jakinarazpenaId: jakinarazpena,
                action: 'locked'
            };
            
            $.ajax({
                url: jakinarazpenakLockedActionUrl,
                type: 'POST',
                dataType: 'json',
                data: dataForm,
                success: function(data) {
                    
                    if (data.status) {
                        
                        $('button[data-jakinarazpena='+jakinarazpena+'][data-action=locked]').remove();
                        $('#blokeatutaEdukiakDialog .modal-body .link-edukia').html('');
                        $('#blokeatutaEdukiakDialog #locked').addClass('hide');
                        $('#blokeatutaEdukiakDialog .modal-body .textDescription').addClass('hide');
                        
                    }
                    
                    $('#blokeatutaEdukiakDialog .modal-body .textMessage').removeClass('hide').text(data.message);
                    
                },
                error:function(data) {
                    console.error(data);
                }
            });
            
        });
        
        $('#blokeatutaEdukiakDialog #unlocked').on('click', function() {
            
            $('#blokeatutaEdukiakDialog .modal-header em').text('');
            $('#blokeatutaEdukiakDialog .modal-body .link-edukia').html('');
            $('#blokeatutaEdukiakDialog').attr('data-jakinarazpena', '');
            $('#blokeatutaEdukiakDialog #locked').removeClass('hide');
            $('#blokeatutaEdukiakDialog .modal-body .textDescription').removeClass('hide');
            $('#blokeatutaEdukiakDialog .modal-body .textMessage').addClass('hide')
            $('#blokeatutaEdukiakDialog').modal('hide');
            
        });
        
        var replySuggestions = function(jakinarazpenaId) {
            
            $.ajax({
                url: jakinarazpenaKexaActionUrl,
                type: 'POST',
                dataType: 'json',
                data: {
                    jakinarazpenaKexa: jakinarazpenaId,
                    actionMezuak: 'reply' 
                },
                success: function(data) {
                    
                    if (data.status === true) {
                        
                        $('#actionInstance').val('reply');
                        
                        $('#jakinarazpenakId').val(data.jakinarazpenaId);
                        $('#jakinarazpenakDialog .modal-header em').text(data.erabiltzaileaIzena);
                        
                        $('#jakinarazpenakDialog').modal({
                            show: true,
                            backdrop: 'static',
                            keyboard: false,
                        });
                        
                    }
                    
                },
                error:function(data) {
                    console.error(data);
                }
            });
            
        };
        
        $('#tab-recursos button').on('click', function(event) {
            event.preventDefault();
            var element = $(this);
            
            var elementAction = element.attr('data-action');
            var elementInstance = element.attr('data-instance');
            var elementJakinarazpena = element.attr('data-jakinarazpena');
            
            if (elementAction == 'reply') {
                
                replySuggestions(elementJakinarazpena);
                return false;
            } else if (elementAction == 'contactPersonal') {
                
                contactPersonal(elementJakinarazpena)
                return false;
                
            } else if (elementAction == 'locked') {
                
                lockedEdukia(elementJakinarazpena);
                return false;
            }
            
            var dataForm = {
                action: elementAction,
                instance: elementInstance,
                jakinarazpena: elementJakinarazpena,
            };
            
            $.ajax({
                url: jakinarazpenakActionUrl,
                type: 'POST',
                dataType: 'json',
                data: dataForm,
                success: function(data) {
                    
                    if (data.status) {
                        var trContect = $('tr[data-jakinarazpena=' + elementJakinarazpena + ']');
                        
                        switch (data.instance) {
                            
                            case 'accept':
                                trContect.addClass('success');
                                $('[data-jakinarazpena=' + elementJakinarazpena + '][data-action=accept]').remove();
                                $('[data-jakinarazpena=' + elementJakinarazpena + '][data-action=reject]').remove();
                                break;
                                
                            case 'reject':
                                trContect.addClass('danger');
                                $('[data-jakinarazpena=' + elementJakinarazpena + '][data-action=accept]').remove();
                                $('[data-jakinarazpena=' + elementJakinarazpena + '][data-action=reject]').remove();
                                break;
                                
                            case 'viewContent':
                                window.location = data.url;
                                break;
                                
                            case 'deleteNotification':
                                trContect.html($('<td colspan="5" class="alert alert-danger">').text('Jakinarazpena ezabatu egin da'));
                                break;
                                
                            case 'markView':
                                trContect.removeClass('isNew');
                                trContect.addClass('isView');
                                element.remove();
                                break;
                                
                            default:
                                console.info('default');
                                break;
                        }
                        
                    } else {
                        console.error(data);
                    }
                    
                },
                error:function(data) {
                    console.error(data);
                }
            });
            
        });
        
    });
})(jQuery);