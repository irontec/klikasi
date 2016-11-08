;(function ( $, window, document, undefined ) {

    var pluginName = 'gmaps',
        defaults = {
            draggable: true,
            zoom: 15,
            height: 450,
            width: 100,
            defaultLat : 43.262951899365135,
            defaultLng : -2.9352541503906195,
            title: "Helbidea"
        };

    function Plugin( element, options ) {
        this.element = element;
        this.$el = $(element);

        this.imgUrl = '//maps.googleapis.com/maps/api/staticmap?center=%lat%,%lng%&zoom=%zoom%&size=%width%x%height%&sensor=false';
        this.markerUrl = '&markers=color:red%7C%lat%,%lng%';
        this.geocoder = null;
        this.map = null;
        this.marker = null;
        this.greenPin = 'http://maps.google.com/mapfiles/ms/icons/green-dot.png';

        this.prevAddress = $(element).val();

        this.options = $.extend( {}, defaults, options) ;

        this._defaults = defaults;
        this._name = pluginName;

        this.create();
    }

    Plugin.prototype.create = function () {
        this.loadNodes();

        var self = this;
        if ( !window.google ) {
            var script = document.createElement("script");
            script.type = "text/javascript";
            script.src = "//www.google.com/jsapi?sensor=false&language=eu";
            document.head.appendChild(script);
        }

        (function lazyGoogle() {

            if (!window.google) {
                setTimeout(lazyGoogle,450);
                return;
            }

            google.load("maps", "3", {
                callback: function(){
                    self.initMap();
                    self.bindEvents();
                },
                other_params: "sensor=false&language=eu"
            });
        })();
    };

    Plugin.prototype.loadNodes = function () {
        var context = this.$el.parent("div");
        //$('<h3>').text(this.options.title).appendTo(context);
        this.options.adress = $('<input>').attr({
                'id' : 'helbideKutxa',
                'type': 'text',
                'class': 'form-control',
                'placeholder': 'Kokapena',
                'value': this.prevAddress
            }).appendTo(context);
        this.options.lat = $('<input>').attr({
                'type': 'hidden',
                'id': 'lat',
                'name' : 'lat'
            }).appendTo(context);
        this.options.lng = $('<input>').attr({
                'type': 'hidden',
                'id': 'lng',
                'name' : 'lng'
            }).appendTo(context);
        this.options.city = $('<input>').attr({
                'type': 'hidden',
                'id': 'herria',
                'name' : 'herria'
            }).appendTo(context);
        this.options.province = $('<input>').attr({
                'type': 'hidden',
                'id': 'probintzia',
                'name' : 'probintzia'
            }).appendTo(context);

        this.options.canvas = $('<div>').attr('class', 'mapCanvas').appendTo(context);

        this.options.canvas.css({width: this.options.width + '%', height: this.options.height});
    };

    Plugin.prototype.initMap = function () {
        var self = this;

        this.geocoder = new google.maps.Geocoder();

        lat = this.options.defaultLat;
        lng = this.options.defaultLng;

        var latLng = new google.maps.LatLng(lat, lng);

        this.map = new google.maps.Map(this.options.canvas[0], {
            zoom: this.options.zoom,
            center: latLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        this.marker = new google.maps.Marker({
            position: latLng,
            title: 'Point A',
            map: this.map,
            draggable: this.options.draggable
        });

        // Update current position info.
        if (this.prevAddress) {
            this.geocode(this.prevAddress);
        } else {
            this.updateMarkerPosition(latLng);
        }

        google.maps.event.addListener(this.marker, 'dragend', function() {
            self.updateMarkerPosition(self.marker.getPosition());
            self.map.setCenter(self.marker.getPosition());
            self.geocodePosition(self.marker.getPosition());
            self.options.adress.trigger('change');
        });

        // Show new marker on Map Move
        var $currentMap = this.map;
        google.maps.event.addListener($currentMap, 'dragend', (function($currentMap){
            return function() {
                var center = $currentMap.getCenter();
                self.marker.setMap(null);
                var marker = new google.maps.Marker({
                    position: center,
                    map: $currentMap,
                    icon: self.greenPin,
                    draggable: true
                });
                $currentMap.setCenter(center);
                $currentMap.marker = marker;
                self.marker = marker;
                google.maps.event.addListener(marker, 'dragend', (function(marker){
                    return function() {
                        marker.setIcon();
                        self.updateMarkerPosition(marker.getPosition());
                        self.geocodePosition(marker.getPosition());
                        self.map.setCenter(marker.getPosition());
                        self.options.adress.trigger('change');
                    }
                })(marker));
            }
        })($currentMap));
    };

    Plugin.prototype.bindEvents = function() {
        var self = this;

        this.options.adress.keyup(function(e){
            if(e.keyCode == 13)
            {
                $(this).blur();
                self.geocode($(this).val());
            }
        });

        this.options.adress.on('change', function(){
            self.updateMarkerAddress($(this).val());
        });
    };

    Plugin.prototype.geocode = function (address) {
        var self = this;
        this.geocoder.geocode({
          'address': address,
          'partialmatch': true
        },
        function (results, status) {
            if (status == 'OK' && results.length > 0) {
                self.map.fitBounds(results[0].geometry.viewport);
                self.marker.setPosition(results[0].geometry.location);
                self.updateMarkerPosition(results[0].geometry.location);
            } else {
                alert("Geocode was not successful for the following reason: " + status);
            }
        });
    };

    Plugin.prototype.geocodePosition = function (pos) {
        var self = this;
        this.geocoder.geocode({
            latLng: pos
        }, function(responses) {
            if (responses && responses.length > 0) {
                self.updateMarkerAddress(responses[0].formatted_address);
            } else {
                self.updateMarkerAddress(null);
            }
        });
    };

    Plugin.prototype.updateMarkerPosition =  function(latLng) {
        this.options.lat.val(latLng.lat());
        this.options.lng.val(latLng.lng());
        var self = this;
        this.geocoder.geocode({
            'latLng': latLng
        }, function (results, status){
            if (status == 'OK' && results.length > 0) {
                for (var i = 0; i < results[0].address_components.length; i++) {
                    var addr = results[0].address_components[i];
                    if (addr.types[0] == ['administrative_area_level_2']) {
                        self.options.province.val(addr.long_name);
                    } else if (addr.types[0] == ['locality']) {
                        self.options.city.val(addr.long_name);
                    }
                }
            }
        });
    };

    Plugin.prototype.updateMarkerAddress = function(str) {
        this.options.adress.val(str);
        this.$el.val(str);
    }


    $.fn[pluginName] = function ( options ) {
        return this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName,
                new Plugin( this, options ));
            }
        });
    }

})( jQuery, window, document );