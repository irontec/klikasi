(function($) {
$(document).ready(function() {

    var isMobile = window.custonScreenMatch && window.custonScreenMatch.matches;

    var kategoriakIsotope = function() {
        window.isotope = $('#kategoriak-list').isotope({
            itemSelector: '.resumen-categoria',
            getSortData: {
            },
            sortAscending: true
        });
    };

    var edukiakIsotope = function() {
        window.isotope = $('.container-filter').isotope({
            itemSelector: '.resumen-ficha',
            getSortData: {
            },
            sortAscending: true,
            isOriginLeft: !isMobile
        });
    };

    /**
     * TRUE  Listado de categorias
     * FALSE Listado de recursos
     */
    if ($('#kategoriak-list').length == 1) {

        if (isMobile) {
            setTimeout(function() {
                kategoriakIsotope();
            },1000);
        } else {
            kategoriakIsotope();
        }

        if (parseInt($('span.countKategoriak').text(), 10) <= $('div.resumen-categoria').length) {

            if ($('div.resumen-categoria').length) {
                $('.loadMoreKategoriak').replaceWith($('<p class="alert alert-success">').text('Kategoriarik ez.'));
            } else {
                $('.loadMoreKategoriak').remove();
            }

        }

        $('.ficha-img').load(function() {
            $('.container-categorias').isotope();
        });

    } else {
        if (isMobile) {
            setTimeout(function() {
                edukiakIsotope();
                //$('.resumen-ficha').css('left','50%')
            },1000);
        } else {
            edukiakIsotope();
        }

        if (parseInt($('span.countEdukiakKategoria').text(), 10) <= $('div.resumen-ficha').length) {

            if ($('div.resumen-ficha').length == 0) {
                $('.loadMoreEdukiak').replaceWith($('<p class="alert alert-success">').text('Edukirik ez.'));
            } else {
                $('.loadMoreEdukiak').remove();
            }

        }

        $('.ficha-img').load(function() {
            $('.container-filter').isotope();
        });
    }


    /**
     * Paginación de las Kategorias.
     */
    var loadMoreKategoriak = $('.loadMoreKategoriak');
    loadMoreKategoriak.on('click', function() {

        loadMoreKategoriak.prop('disabled', true);

        var url = loadMoreKategoriak.attr('data-url');
        var currentPage = loadMoreKategoriak.attr('data-page');
        var newPage = (parseInt(currentPage) + 1);

        var data = {
            page: newPage
        };

        $.post(
            url,
            data,
            function(data, textStatus) {

                loadMoreKategoriak.prop('disabled', false);

                if (textStatus) {
                    if (data.success) {

                        $.each(data.htmls.list, function( key, val) {
                            $('#kategoriak-list').isotope('insert', $(val));
                        });
                        loadMoreKategoriak.attr('data-page', newPage);
                    }

                    $('.ficha-img').load(function() {
                        $('.container-categorias').isotope();
                    });

                    /*if (parseInt($('span.countKategoriak').text(), 10) <= $('div.resumen-categoria').length) {
                        $('.loadMoreKategoriak').remove();
                    }*/

                    if (!data.success || loadMoreKategoriak.data("itemcount") <= $('div.resumen-categoria').length) {
                        loadMoreKategoriak.replaceWith($('<p class="alert alert-success">').text('Ez dago kategoria gehiagorik.'));
                        setTimeout(function() {
                            $('.alert.alert-success').slideUp('slow');
                        }, 3000);
                    }
                }

          }, 'json');
    });

    /**
     * Paginación de los recursos segun la categoria.
     */
    var loadMoreEdukiak = $('.loadMoreEdukiak');
    loadMoreEdukiak.on('click', function() {

        loadMoreEdukiak.prop('disabled', true);

        var url = loadMoreEdukiak.attr('data-url');
        var currentPage = loadMoreEdukiak.attr('data-page');
        var newPage = (parseInt(currentPage) + 1);
        var kategoriaUrl = loadMoreEdukiak.attr('data-kategoria');

        var data = {
            page: newPage,
            kategoria: kategoriaUrl
        };

        $.post(
            url,
            data,
            function(data, textStatus) {

                loadMoreEdukiak.prop('disabled', false);

                if (textStatus) {
                    if (data.success) {

                        $.each(data.htmls, function( key, val) {
                            $('.container-filter').isotope('insert', $(val));
                        });

                        loadMoreEdukiak.attr('data-page', newPage);

                        $('.ficha-img').load(function() {
                        	$('.container-filter').isotope();
                        });
                    }

                    if (!data.success || parseInt($('span.countEdukiakKategoria').text(), 10) <= $('div.resumen-ficha').length) {

                        loadMoreEdukiak.replaceWith($('<p class="alert alert-success">').text('Ez dago baliabide gehiagorik.'));
                        setTimeout(function() {
                            $('.alert.alert-success').slideUp('slow');
                        }, 3000);
                    }

                }
            }, 'json');
    });

});
})(jQuery);
