$(window).load(function() {
    
    var baseUrl = $('base').attr('href');
    var isNewUrl = baseUrl + 'mezuak/is-new?format=json';
    var replyUrl = baseUrl + 'mezuak/reply-message?format=json';
    var deleteUrl = baseUrl + 'mezuak/delete-message?format=json';
    
    /**
     * Cambia el estado a visto
     */
    $('#accordion .isNew').on('click', function() {
        
        var element = $(this);
        var elementId = element.find('a').attr('href').replace('#collapse-mezuak-', '');
        var sendData = {mezuakId: elementId};
        
        $.ajax({
            url: isNewUrl,
            type: 'POST',
            dataType: 'json',
            data: sendData,
            success: function(data) {
                
                if (data.status) {
                    
                    element.removeClass('isNew');
                    
                }
                
            },
            error:function(data) {
                console.error(data);
            }
        });
        
    });
    
    /**
     * Reinicia todos los formularios de envio.
     */
    $('#accordion .panel-title').on('click', function() {
        
        var buttons = $('#accordion button')
        var textareas = $('#accordion textarea');
        
        $.each(textareas, function(key, element) {
            $(element).val('');
        });
        
        $.each(buttons, function(key, button) {
            var isSuccess = $(button).hasClass('btn-success');
            
            if (isSuccess) {
                $(button).prop('disabled', true);
            }
            
        });
        
    });
    
    $('textarea[name=mezua-reply]').on('keyup', function() {
        
        var element = $(this);
        var mezuakId = element.attr('id').replace('mezua-reply-', '');
        var replyButton = $('#reply-' + mezuakId);
        
        if (element.val().trim() != '') {
            replyButton.prop('disabled', false);
        } else {
            replyButton.prop('disabled', true);
        }
        
    });
    
    $('.panel-group button').on('click', function() {
        
        var element = $(this);
        var mezuakId = element.parents('.mezuak-actions').attr('data-mezuak');
        var mezuakActions = $('#collapse-mezuak-' + mezuakId + ' .mezuak-actions')
        var elementAction = element.attr('id').replace('-' + mezuakId , '');
        var norkId = element.attr('data-nork');
        var container = $('#mezuak-container-' + mezuakId);
        
        if (elementAction == 'reply') {
            
            var textarea = $('#mezua-reply-' + mezuakId);
            var mezuakReply = textarea.val();
            var noriId = textarea.attr('data-nork');
            
            var sendData = {
                mezuakId: mezuakId,
                newMezuak: mezuakReply,
                nori: noriId
            };
            
            $.ajax({
                url: replyUrl,
                type: 'POST',
                dataType: 'json',
                data: sendData,
                success: function(data) {
                    
                    if (data.status) {
                        textarea.parents('.col-xs-8').remove();
                        mezuakActions.replaceWith($('<p class="alert alert-success">').text('Mezua bidalita'));
                    }
                    
                },
                error:function(data) {
                    console.error(data);
                }
            });
            
            
        } else if (elementAction == 'delete') {
            
            var sendData = {
                mezuakId: mezuakId
            };
            
            $.ajax({
                url: deleteUrl,
                type: 'POST',
                dataType: 'json',
                data: sendData,
                success: function(data) {
                    
                    if (data.status) {
                        
                        container.find('.panel-collapse').remove();
                        container.find('.panel-heading').replaceWith($('<p class="alert alert-danger">').text('Mezua ezabatu egin da'));
                        
                    }
                    
                },
                error:function(data) {
                    console.error(data);
                }
            });
            
        }
        
    });
});