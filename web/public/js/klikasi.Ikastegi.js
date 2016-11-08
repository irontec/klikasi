$(window).load(function() {

    var isMobile = window.custonScreenMatch.matches;

    /**
     * init Isotope
     */
    window.isotope = $('.container-filter').isotope({
        itemSelector: '.resumen-ficha',
        sortAscending: true,
        getSortData: {
            moreLikes: '.moreLikes',
            moreViews: '.moreViews',
            moreComments: '.moreComments'
        },
        isOriginLeft: !isMobile
    });
});

(function($) {
    $(document).ready(function() {

        /**
         * Arka
         */
        if ($('#ikastegiaErlazioBerria').length > 0) {

            $('#ikastegiaErlazioBerria').on('click', function(e) {

                var $el = $(this);
                var url = $el.data('url');

                $.getJSON(url, function(data) {

                    if (data.success
                            && data.success == true) {
                        $el.replaceWith($('<p class="alert alert-success">').text(data.message));
                    } else {
                        alert(data.message);
                    }
                });
            });
        }

        if ($('#loadMoreEdukiak').length > 0) {

            if (parseInt($('span.countEdukiakIkastegia').text(), 10) <= $('div.resumen-ficha').length) {
                $('#loadMoreEdukiak').remove();
            }
        }

        /**
         * ddniel
         */

        /**
         * Re-ordena los elementos,
         */
        $(".filtro-buscador strong").on("click", function() {
            $(".container-filter").isotope({
                sortBy: 'original-order'
            });
        });

        /**
         * Ordena los elementos segun el arrtibute "data-sort-by"
         */
        $('.filtro-buscador a').on('click', function() {
            var search = $(this).attr("data-sort-by");

            $(".container-filter").isotope({
                sortBy: search
            });
        });

        /**
         * Paginación de los Ikastegiak
         */
        var loadMoreButton =  $('#loadMoreIkastegiak');
        loadMoreButton.on('click', function() {

            var url = loadMoreButton.attr('data-url');
            var currentPage = loadMoreButton.attr('data-page');
            var newPage = (parseInt(currentPage) + 1);
            var data = {
                page: newPage
            };

            $.post(
                url,
                data,
                function(data, textStatus) {

                    if (textStatus) {
                        if (data.success) {

                            $.each(data.htmls, function(key, val) {
                                $('.list-centros').last().after(val);
                            });

                            loadMoreButton.attr('data-page', newPage);
                        }

                        if (!data.success || $('.list-centros').children(".centro").length ==  loadMoreButton.data("itemcount")) {
                            loadMoreButton.replaceWith($('<p class="alert alert-success">').text('Ez dago ikastegi gehiagorik.'));
                            setTimeout(function() {
                                $('.alert.alert-success').slideUp('slow');
                            }, 3000);
                        }

                    } else {
                        loadMoreButton.replaceWith($('<p class="alert alert-success">').text('Sisteman arazoak emon dira, saiatu ostabere.'));
                    }

              }, "json");

        });

        /**
         * Paginación de los Edukiak
         */
        var loadMoreEdukia = $('#loadMoreEdukiak');
        loadMoreEdukia.on('click', function() {

            var url = loadMoreEdukia.attr('data-url');
            var currentPage = loadMoreEdukia.attr('data-page');
            var ikastegia = $('#loadMoreEdukiak').attr('data-ikastegia');

            var newPage = (parseInt(currentPage) + 1);
            var data = {
                page: newPage,
                ikastegiaId: ikastegia
            };

            $.post(
                url,
                data,
                function(data, textStatus) {

                    if (textStatus) {
                        if (data.success) {

                            $.each(data.htmls, function( key, val) {
                                $(".container-filter").isotope('insert', $(val));
                            })

                            loadMoreEdukia.attr('data-page', newPage);
                        }

                        $('.ficha-img').load(function() {
                            $('.container-filter').isotope();
                        });

                        if (!data.success || parseInt($('span.countEdukiakIkastegia').text(), 10) <= $('div.resumen-ficha').length) {
                            loadMoreEdukia.replaceWith($('<p class="alert alert-success">').text('Ez dago eduki gehiagorik.'));
                            setTimeout(function() {
                                $('.alert.alert-success').slideUp('slow');
                            }, 3000);
                        }

                    } else {
                        loadMoreEdukia.replaceWith($('<p class="alert alert-success">').text('Sisteman arazoak eman dira, saiatu ostabere.'));
                    }

              }, "json");
        });
    });
})(jQuery);
