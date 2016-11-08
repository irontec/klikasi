$(window).load(function() {

    var isMobile = window.custonScreenMatch.matches;

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

        /**
         * Paginación de los Edukiak de un Ikastegia
         */
        var loadMoreEdukia = $('.loadMoreEdukiak');
        loadMoreEdukia.on('click', function() {

            loadMoreEdukia.prop('disabled', true);

            var url = $("base").prop("href") + loadMoreEdukia.attr('data-url');
            var currentPage = loadMoreEdukia.attr('data-page');
            var newPage = (parseInt(currentPage) + 1);
            var itemCount = $();

            var container = $(".container-filter");

            var data = {
                page: newPage,
            };

            $.post(
                url,
                data,
                function(data, textStatus) {

                    loadMoreEdukia.prop('disabled', false);
                    if (textStatus) {
                        if (data.success) {

                            $.each(data.htmls, function(key, val) {
                                container.isotope('insert', $(val));
                            })

                            loadMoreEdukia.attr('data-page', newPage);

                            $('.ficha-img').load(function() {
                            	$('.container-filter').isotope();
                            });
                        }

                        if (!data.success || loadMoreEdukia.data("itemcount") == container.children().length) {
                            loadMoreEdukia.replaceWith($('<p class="alert alert-success">').text('Ez dago elementu gehiagorik.'));
                            setTimeout(function() {
                                $('.alert.alert-success').slideUp('slow');
                            }, 3000);
                        }
                    }

              }, "json");
        });

        /**
         * Botones Sociales Me Gusta/Favorito
         */
        $('.social').on('click', function(event) {

            var $el = $(event.target);
            var input = $(event.target);
            var inputId = input.attr('id');

            if (inputId == 'atseginDut') {

                var url = input.attr('data-url');
                $.getJSON(url, function(data) {

                    if (data.success
                            && data.success == true) {
                        $el.replaceWith($(data.button));
                    } else {
                        alert(data.message);
                    }
                });

            } else if (inputId == 'gogokoenetaraGehitu') {

                var url = input.attr('data-url');
                $.getJSON(url, function(data) {

                    if (data.success
                            && data.success == true) {
                        $el.replaceWith($(data.button));
                    } else {
                        alert(data.message);
                    }

                });

            }

        });//.social


        $("#edukiaModeration button").on('click', function (e) {

            if ($(this).data("url")) {

                var currentButton = $(this);
                $.post($(this).data("url"), function (resp) {
                    currentButton.parents("div.alert").slideUp();
                });
            }
        });

        /**
         * Aceptar/Rechazar Comentarios
         */
        $('#comentarios-iruzkinak').on('click', function(event) {

            var $el = $(event.target);
            var input = $(event.target);
            var inputId = input.attr('id');

            if (inputId == 'iruzkinaModeration-accept') {

                var url = input.attr('data-url');

                $.getJSON(url, function(data) {

                    var alertDiv = $('#iruzkina-' + data.iruzkinaId);

                    if (data.success
                            && data.success == true) {
                        alertDiv.replaceWith($('<p class="alert alert-success">').text(data.message));
                    } else {
                        alert(data.message);
                    }

                });

            } else if (inputId == 'iruzkinaModeration-reject') {

                var url = input.attr('data-url');

                $.getJSON(url, function(data) {

                    var alertDiv = $('#iruzkina-' + data.iruzkinaId);

                    if (data.success
                            && data.success == true) {
                        alertDiv.replaceWith($('<p class="alert alert-warning">').text(data.message));
                    } else {
                        alert(data.message);
                    }

                });

            }

        });//#comentarios-iruzkinak

        /**
         * Diablog "Hobekuntza proposatu"
         */
        var dialogHobekuntzak = $('#hobekuntzak-dialog');
        var buttonProposatu = dialogHobekuntzak.find('button[id=hobekuntzak]');
        var buttonClose = dialogHobekuntzak.find('button[id=dialogClosed]');

        $('#hobekuntzak').on('click', function() {

            dialogHobekuntzak.modal({
                show: true,
                backdrop: 'static',
                keyboard: false,
            });

            var content = dialogHobekuntzak.find('textarea[name=hobekuntzak]');

            if (content.val().trim() == '') {
                buttonProposatu.prop('disabled', true);
            }

            $(content).on('keyup', function(event) {

                if (content.val().trim() == '') {
                    buttonProposatu.prop('disabled', true);
                } else {
                    buttonProposatu.prop('disabled', false);
                }

            });

        });//#hobekuntzakProposatu

        buttonClose.on('click', function(event) {
            event.preventDefault();

            var content = dialogHobekuntzak.find('textarea[name=hobekuntzak]');
            content.val('');
            content.prop('disabled', false);
            buttonProposatu.prop('disabled', true);
            buttonProposatu.removeClass('hide');
            dialogHobekuntzak.modal('hide');

            dialogHobekuntzak.find('p.alert').replaceWith('<div id="magic-hobekuntzak">')

        });

        $(buttonProposatu).on('click', function(event) {
            event.preventDefault();

            var magicDiv = $("#magic-hobekuntzak");

            magicDiv.html('<i class="fa fa-refresh fa-spin fa-stack-2x"></i>');

            var content = dialogHobekuntzak.find('textarea[name=hobekuntzak]');
            var messageContent = content.val();

            var urlHobekuntzak = buttonProposatu.attr('data-url');
            var form = dialogHobekuntzak.find('form');
            var dataForm = form.serializeArray();

            content.prop('disabled', true);

            $.ajax({
                url: urlHobekuntzak,
                type: 'POST',
                dataType: 'json',
                data: dataForm,
                success: function(data) {

                    if (data.success) {
                        magicDiv.replaceWith($('<p class="alert alert-success">').text(data.message));
                        buttonProposatu.addClass('hide');
                    } else {
                        magicDiv.replaceWith($('<p class="alert alert-danger">').text('Sisteman arazoak emon dira, saiatu ostabere.'));
                        buttonProposatu.addClass('hide');
                    }

                },
                error:function(data) {
                    console.error(data);
                }
            });

        });

        /**
         * Diablog "Salatu"
         */
        var dialogSalatu = $('#salatu-dialog');
        var buttonSalatu = dialogSalatu.find('button[id=salatu]');
        var buttonCloseSalatu = dialogSalatu.find('button[id=dialogClosed]');

        $('#salatu').on('click', function() {

            dialogSalatu.modal({
                show: true,
                backdrop: 'static',
                keyboard: false,
            });

            var content = dialogSalatu.find('textarea[name=salatu]');

            if (content.val().trim() == '') {
                buttonSalatu.prop('disabled', true);
            }

            $(content).on('keyup', function(event) {

                if (content.val().trim() == '') {
                    buttonSalatu.prop('disabled', true);
                } else {
                    buttonSalatu.prop('disabled', false);
                }

            });

        });//#salatu

        buttonCloseSalatu.on('click', function(event) {
            event.preventDefault();

            var content = dialogSalatu.find('textarea[name=salatu]');
            content.val('');
            content.prop('disabled', false);
            buttonSalatu.prop('disabled', true);
            buttonSalatu.removeClass('hide');
            dialogSalatu.modal('hide');

            dialogSalatu.find('p.alert').replaceWith('<div id="magic-salatu">')

        });

        $(buttonSalatu).on('click', function(event) {
            event.preventDefault();

            var magicDiv = $("#magic-salatu");

            magicDiv.html('<i class="fa fa-refresh fa-spin fa-stack-2x"></i>');

            var content = dialogSalatu.find('textarea[name=salatu]');
            var messageContent = content.val();

            var urlSalatu = buttonSalatu.attr('data-url');
            var form = dialogSalatu.find('form');
            var dataForm = form.serializeArray();

            content.prop('disabled', true);

            $.ajax({
                url: urlSalatu,
                type: 'POST',
                dataType: 'json',
                data: dataForm,
                success: function(data) {

                    if (data.success) {
                        magicDiv.replaceWith($('<p class="alert alert-success">').text(data.message));
                        buttonSalatu.addClass('hide');
                    } else {
                        magicDiv.replaceWith($('<p class="alert alert-danger">').text('Sisteman arazoak emon dira, saiatu ostabere.'));
                        buttonSalatu.addClass('hide');
                    }

                },
                error:function(data) {
                    console.error(data);
                }
            });

        });


        /**
         * Dialog Iniciar Sesión.
         */
        $('button.sartuDialog').on('click', function() {
            sartuDialogShow();
        });
        $('#sartuDialogHobekuntzak').on('click', function() {
            sartuDialogShow();
        });

        $('#sartuFormDialog button#close').on('click', function(event) {
            event.preventDefault();
            sartuDialogHide();
        });

        function sartuDialogShow() {
            var dialog = $('#sartuDialog');
            dialog.modal({
                show: true,
                backdrop: 'static',
                keyboard: false,
            });
        }

        function sartuDialogHide() {
            var dialog = $('#sartuDialog');
            $("#sartuDialog input").val('')
            dialog.modal('hide');
        }

        $('#sartuDialog form').on('submit', function(event) {

            event.preventDefault();
            event.stopPropagation();

            var idForm = '#sartuFormDialog';
            var divLoading = $(idForm +' .sartuLoading');
            var dataForm = $(idForm).serializeArray();
            var urlAction = $(idForm).attr('data-url');

            $(idForm +' input').prop('disabled', true);
            $(idForm +' button#bidali').prop('disabled', true);

            divLoading.html('<i class="fa fa-refresh fa-spin fa-stack-2x"></i>');

            $.post(
                urlAction,
                dataForm,
                function(data, textStatus) {

                    $(idForm + ' .messageWarningForm').addClass('hide');
                    $(idForm + ' .messageWarningForm').find('alert').html('');

                    if (textStatus) {
                        if (data.status == true) {
                            window.location.reload();
                        } else {

                            divLoading.html('');
                            $(idForm +' input').prop('disabled', false);
                            $(idForm +' button#bidali').prop('disabled', false);
                            $(idForm + ' .messageWarningForm').removeClass('hide');

                            $(idForm + ' .messageWarningForm').find('.error').text(data.message);

                            $('#sartuFormDialog [name=erabiltzailea]').parents('.form-group').addClass('has-error');
                            $('#sartuFormDialog [name=pasahitza]').parents('.form-group').addClass('has-error');

                        }
                    } else {
                        $(idForm + ' .messageWarningForm').html('Sisteman arazoak emon dira, saiatu ostabere.');
                    }

              }, "json");

        });

        /**
         * END Dialog Iniciar Sesión.
         */

        /**
         * Ventanas para compartir en redes Sociales.
         */
        $('.shareSocials a').on('click', function(event) {
            event.preventDefault();

            var url = $(this).attr('data-url');
            var name = $(this).attr('data-name');

            window.open(url,'', 'toolbar=0, status=0, width=650, height=450');

        });

        /**
         * Responder a un Comentario.
         */
        $('span.respond-comment').on('click', function(event) {
            event.preventDefault();

            var $el = $(event.target).parents('span');
            var elementId = $el.attr('id');
            var comment = $('p#' + elementId).text().trim();

            var heightNavbar = $('header.header .navbar').height()*3;
            var fichasRelacionadas = $('.fichas-relacionadas').height();
            var footer = $('footer').height();
            var commentForm = $('.input-comentario').height();

            var commentView = $(document).height() - fichasRelacionadas - footer - commentForm - heightNavbar;

            $('html, body').animate({
                scrollTop: commentView
            }, 'slow');

            $('.response-comment').html(comment);
            $('div.alert.alert-info').removeClass('hide');


            $('input[name=responseIruzkina]').val(elementId);

        });

        /**
         * Cancelar el responder a un comentario
         */
        $('.close.cancel-response').on('click', function(event) {
            event.preventDefault();
            $('.response-comment').html('');
            $('div.alert.alert-info').addClass('hide');
            $('input[name=responseIruzkina]').val('');
        });

        /**
         * Si no hay 3 fichas, se quita el boton "Load More"
         */
        if ($('.resumen-ficha').length < 3) {
            $('.row.load').remove()
        }

    });
})(jQuery);
