(function($) {
    $(document).ready(function() {
        
        var baseUrl = $('base').attr('href');
        
        if ($('input[data-plugin="avatarSelector"]').length > 0) {
            $('input[data-plugin="avatarSelector"]').avatarSelector();
        }
        
        $('#kontaktatu').on('click', function() {
            $('#kontaktua-dialog').modal({
                show: true,
                backdrop: 'static',
                keyboard: false,
            });
        });//#kontaktatu
        

        $('#kontaktua-dialog form').submit(function(event) {

            event.preventDefault();

            var dataForm = $('#kontaktua-dialog form').serializeArray();
            var mezuaAction = baseUrl + 'json/mezua?format=json';
            
            var textareaForm = $('#kontaktua-dialog textarea');
            var buttonSend = $('#kontaktua-dialog [data-action=send]');
            var buttonClosed = $('#kontaktua-dialog [data-action=closed]');
            
            textareaForm.prop('disabled', true);
            buttonSend.prop('disabled', true);
            buttonClosed.prop('disabled', true);
            
            $.ajax({
                url: mezuaAction,
                type: 'POST',
                dataType: 'json',
                data: dataForm,
                success: function(data) {
                    
                    buttonClosed.prop('disabled', false);
                    
                    if (data.status) {
                        
                        textareaForm.parents('.form-group').addClass('has-success');
                        var messageSuccess = $('<span>').html(data.mezuak);
                        textareaForm.parents('.elementTextarea').append(messageSuccess);
                        
                    } else {
                        
                        textareaForm.prop('disabled', false);
                        buttonSend.prop('disabled', false);
                        
                        if (data.error.mezuak != undefined) {
                            
                            textareaForm.parents('.form-group').addClass('has-error');
                            var messageError = $('<span>').html(data.error.mezuak).addClass('msg').addClass('error');
                            textareaForm.parents('.elementTextarea').append(messageError);
                            
                            setTimeout(function() {
                                messageError.remove();
                                textareaForm.parents('.form-group').removeClass('has-error');
                            }, 3000);
                            
                        } else {
                            $('#kontaktua-dialog textarea').val('');
                            $('#kontaktua-dialog').modal('hide');
                        }
                        
                    }
                    
                },
                error:function(data) {
                    console.error(data);
                }
            });
            
        });//#kontaktua-dialog [data-action=send]
        
        $('#kontaktua-dialog [data-action=closed]').on('click', function() {
            event.preventDefault();
            
            $('#kontaktua-dialog textarea').val('');
            $('#kontaktua-dialog').modal('hide');
            
        });//#kontaktua-dialog [data-action=closed]
        
        $('#editatu').on('click', function() {
            window.location = baseUrl + 'egileak';
        });//#editatu
        
        var isMobile = window.custonScreenMatch && window.custonScreenMatch.matches;
        
        var containerRec = function() {
            
            $('.container-filter.rec').isotope({
                itemSelector: '.resumen-ficha',
                sortBy: 'original-order',
                isOriginLeft: !isMobile
            });
        };
        
        setTimeout(function() {
            containerRec();
        }, 100);
        
        var containerValidados = function() {
            $('.container-filter.rValidados').isotope({
                itemSelector: '.resumen-ficha',
                getSortData: {
                },
                sortAscending: true,
                isOriginLeft: !isMobile
            });
        };
        
        var containerFavoritos = function() {
            $('.container-filter.rFavoritos').isotope({
                itemSelector: '.resumen-ficha',
                sortBy: 'original-order',
                isOriginLeft: isMobile
            });
            
        };
        
        $('.nav-tabs li').on('click', function() {
            var element = $(this);
            
            var tabSelected = element.attr('data-tab');
            
            switch (tabSelected) {
                case 'rec':
                    setTimeout(function() {
                        containerRec();
                    },100);
                    break;
                    
                case 'rValidados':
                    setTimeout(function() {
                        containerValidados();
                    },100);
                    break;
                    
                case 'rFavoritos':
                    setTimeout(function() {
                        containerFavoritos();
                    },100);
                    break;
            }
            
        });
        
        $('tab-content div.tab-pane').on('cssClassChanged', function() {
            console.info('lol');
        });
        
    });
})(jQuery);