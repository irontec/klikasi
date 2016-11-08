;(function ( $, window, document, undefined ) {

    var pluginName = 'ikastegiSelector',
        defaults = {
            probintziaListUrl: "ikastegiak/probintzia-zerrenda",
            herriListUrl: "ikastegiak/herrien-zerrenda/probintzia/",
            ikastegiListUrl: "ikastegiak/ikastegien-zerrenda/herria/",
            irakasleListUrl: "ikastegiak/irakasleen-zerrenda/ikastegia/"
        };

    function Plugin( element, options ) {
        this.element = element;
        this.options = $.extend( {}, defaults, options) ;

        this._defaults = defaults;
        this._name = pluginName;

        this.irakasleaHautatu = $(element).attr('data-irakaslea-hautatu');
        this.options.baseUrl = $('base').attr('href');
        this.init();
    }

    Plugin.prototype.init = function () {
        this.drawWrappers();
        this.loadProvinces();
    };

    Plugin.prototype.drawWrappers = function () {
        this.wrapper = $(this.element).parent('div');
        this.textWrapper = $('<div>')
            .attr('id', 'ikastegiTextBox')
            .appendTo(this.wrapper);
        $('<h3>').text('Ikastegia aukeratu').appendTo(this.textWrapper);
        this.boxWrapper = $('<div>').attr('id','ikastegiSelectorBox').appendTo(this.textWrapper);
    };

    Plugin.prototype.loadProvinces = function () {
        var self = this;
        var url = this.options.baseUrl + this.options.probintziaListUrl + '?format=json';
        $.getJSON(url, function(data) {
            if (data.success && data.probintziak) {
                var select = $('<select>')
                    .attr('id', 'provinceSelector')
                    .on('change', function(e){
                        self.loadTowns(this.options[e.target.selectedIndex].value);
                    });
                $('<option>')
                    .attr({
                        'name' : 'batez',
                        'value' : 'batez'
                    }).appendTo(select);
                $.each(data.probintziak, function(i,item){
                    $('<option>')
                        .attr({
                            'name' : item,
                            'value' : item
                        }).text(item)
                        .appendTo(select);
                });
                select.appendTo(self.boxWrapper);
            }
        });
    };

    Plugin.prototype.loadTowns = function (province) {
        if (typeof(this.townContainer) === "undefined") {
            this.townContainer = $('<div>').attr('id','townContainer').appendTo(this.boxWrapper);
        } else {
            this.townContainer.html('');
            this.ikastegiContainer.html('');
            this.selectedIkastegi.remove();
            this.addButton.remove();
        }
        if (province == 'batez') return;
        var self = this;
        var url = this.options.baseUrl + this.options.herriListUrl + province + '?format=json';
        $.getJSON(url, function(data) {
            if (data.success && data.herriak) {
                var select = $('<select>')
                    .attr('id', 'townSelector')
                    .on('change', function(e){
                        self.loadIkastegiak(this.options[e.target.selectedIndex].value);
                    });
                $('<option>')
                    .attr({
                        'name' : 'batez',
                        'value' : 'batez'
                    }).appendTo(select);
                $.each(data.herriak, function(i,item){
                    $('<option>')
                        .attr({
                            'name' : item,
                            'value' : item
                        }).text(item)
                        .appendTo(select);
                });
                select.appendTo(self.townContainer);
            }
        });
    };

    Plugin.prototype.loadIkastegiak = function (herria) {
        if (typeof(this.ikastegiContainer) === "undefined") {
            this.ikastegiContainer = $('<div>').attr('id','ikastegiContainer').appendTo(this.boxWrapper);
        } else {
            this.ikastegiContainer.html('');
            this.selectedIkastegi.remove();
            this.addButton.remove();
        }
        if (herria == 'batez') return;
        this.herria = herria;
        var self = this;
        var url = this.options.baseUrl + this.options.ikastegiListUrl + herria + '?format=json';
        $.getJSON(url, function(data) {
            if (data.success && data.ikastegiak) {
                var select = $('<select>')
                    .attr('id', 'ikastegiSelector')
                    .on('change', function(e){
                        self.aukeratutakoIkastegia = this.options[e.target.selectedIndex].value;
                        if (typeof(self.selectedIkastegi) === "undefined") {
                            self.selectedIkastegi = $('<input>')
                                .attr({
                                    'type' : 'hidden',
                                    'name' : 'ikastegia',
                                    'id' : 'ikastegia',
                                    'value' : self.aukeratutakoIkastegia
                                });
                        }
                        if (!$('button#addButton', self.ikastegiContainer).length > 0) {
                            self.addButton = $('<button>')
                                .attr({
                                    'id':'addButton',
                                    'type' : 'button',
                                    'class' : 'btn btn-primary'
                                })
                                .text('Aukeratu')
                                .on('click', function(e){
                                    e.preventDefault();
                                    if (!$('input#ikastegia', self.wrapper).length > 0) {
                                        self.selectedIkastegi.appendTo(self.wrapper);
                                    }
                                    self.selectedIkastegi.attr('value', self.aukeratutakoIkastegia);
                                    self.cleanIkastegia();
                                }).appendTo(self.ikastegiContainer);
                        }
                    });
                $('<option>')
                    .attr({
                        'name' : 'batez',
                        'value' : 'batez'
                    }).appendTo(select);
                $.each(data.ikastegiak, function(i,item){
                    $('<option>')
                        .attr({
                            'id' : item.id,
                            'name' : item.izena,
                            'value' : item.id
                        }).text(item.izena)
                        .appendTo(select);
                });
                select.appendTo(self.ikastegiContainer);
            }
        });
    }

    Plugin.prototype.cleanIkastegia = function () {
        if (typeof(this.selectedIkastegiaName) === "undefined") {
            this.selectedIkastegiaName = $('<div>').attr('id', 'selectedIkastegiaName');
        } else {
            this.selectedIkastegiaName.html('');
            this.selectedIkastegiaName.show();
        }
        var ikastegiaName = '';
        var self = this;
        $.each($('option:selected', this.boxWrapper), function(i,item) {
            if ( i == 0) {
                ikastegiaName += $(item).attr('name') + ' ';
            } else {
                ikastegiaName += '| ' + $(item).attr('name') + ' ';
            }
        });
        var button = $('<button>')
            .attr('id','editButton')
            .text('Aldatu')
            .on('click', function(e){
                e.preventDefault();
                self.selectedIkastegiaName.hide();
                self.selectedIkastegi.remove();
                self.boxWrapper.show();
                self.irakasleContainer.hide();
                self.selectedIrakasleaName.remove();
            }).appendTo(this.selectedIkastegiaName);
        $('<p>').attr('id', 'ikastegiName').text(ikastegiaName).append(button).appendTo(this.selectedIkastegiaName);
        this.selectedIkastegiaName.appendTo(this.wrapper);
        this.boxWrapper.hide();
        this.checkIrakaslea();
    }

    Plugin.prototype.checkIrakaslea = function () {

        if (this.irakasleaHautatu == true) {
            var self = this;
            if (typeof(this.irakasleContainer) === "undefined") {
                this.irakasleContainer = $('<div>').attr('id', 'irakasleBox');
            } else {
                this.irakasleContainer.html('');
                this.irakasleContainer.show();
            }
            $('<h3>').text('Irakaslea aukeratu').appendTo(this.irakasleContainer);
            var url = this.options.baseUrl + this.options.irakasleListUrl + this.aukeratutakoIkastegia + '?format=json';
            $.getJSON(url, function(data) {
                if (data.success && data.irakasleak) {
                    var select = $('<select>')
                        .attr('id', 'irakasleSelector')
                        .on('change', function(e){
                            self.aukeratutakoIrakaslea = this.options[e.target.selectedIndex].value;
                            if (typeof(self.selectedIrakasle) === "undefined") {
                                self.selectedIrakasle = $('<input>')
                                .attr({
                                    'type' : 'hidden',
                                    'name' : 'irakaslea',
                                    'id' : 'irakaslea',
                                    'value' : self.aukeratutakoIrakaslea
                                });
                            }
                            if (!$('button#addIrakasleButton', self.irakasleContainer).length > 0) {
                                self.addButton = $('<button>')
                                .attr('id','addIrakasleButton')
                                .text('Aukeratu')
                                .on('click', function(e){
                                    e.preventDefault();
                                    if (!$('input#irakaslea', self.wrapper).length > 0) {
                                        self.selectedIrakasle.appendTo(self.wrapper);
                                    }
                                    self.selectedIrakasle.attr('value', self.aukeratutakoIrakaslea);
                                    self.cleanIrakaslea();
                                }).appendTo(self.irakasleContainer);
                            }
                        });
                    $('<option>')
                        .attr({
                            'name' : 'batez',
                            'value' : 'batez'
                        }).appendTo(select);
                    $.each(data.irakasleak, function(i,item){
                        $('<option>')
                            .attr({
                                'id' : item.id,
                                'name' : item.url,
                                'value' : item.id
                            }).text(item.izena + ' ' + item.abizena + ' ' + item.abizena2)
                            .appendTo(select);
                    });
                    select.appendTo(self.irakasleContainer);
                } else {
                    $('<p>').text('Oraindik ez dago irakaslerik ikastegi honetan.').appendTo(self.irakasleContainer);
                }
            });
            this.irakasleContainer.appendTo(this.wrapper);
        }
    };

    Plugin.prototype.cleanIrakaslea = function () {
        if (typeof(this.selectedIrakasleaName) === "undefined") {
            this.selectedIrakasleaName = $('<div>').attr('id', 'selectedIrakasleaName');
        } else {
            this.selectedIrakasleaName.html('');
            this.selectedIrakasleaName.show();
        }
        var irakasleName = '';
        var self = this;
        $.each($('option:selected', this.irakasleContainer), function(i,item) {
            irakasleName += $(item).text() + ' ';
        });
        var button = $('<button>')
            .attr('id','editIrakasleButton')
            .text('Aldatu')
            .on('click', function(e){
                e.preventDefault();
                self.selectedIrakasleaName.hide();
                self.selectedIrakasle.remove();
                self.irakasleContainer.show();
                self.selectedIrakasleaName.hide();
            }).appendTo(this.selectedIkastegiaName);
        $('<h3>').text('Irakaslea aukeratu').appendTo(this.selectedIrakasleaName);
        $('<p>').attr('id', 'irakasleName').text(irakasleName).append(button).appendTo(this.selectedIrakasleaName);
        this.selectedIrakasleaName.appendTo(this.wrapper);
        this.irakasleContainer.hide();
    };

    $.fn[pluginName] = function ( options ) {
        return this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName,
                new Plugin( this, options ));
            }
        });
    }

})( jQuery, window, document );
