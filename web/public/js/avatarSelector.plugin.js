;(function ( $, window, document, undefined ) {

    var pluginName = 'avatarSelector',
        defaults = {
            avatarListUrl: "multimedia/erabiltzaile-irudien-zerrenda",
            imageUploadUrl: "multimedia/avatar-berria",
            imagePreviewUrl: "multimedia/avatar-preview",
            profilePreviewUrl: "multimedia/erabiltzaile-irudia/irudia/",
        };

    function Plugin( element, options ) {
        this.element = element;
        this.$el = $(element);

        this.options = $.extend( {}, defaults, options) ;

        this._defaults = defaults;
        this._name = pluginName;

        this.options.baseUrl = $('base').attr('href');
        this.getPluginOptions();

        this.initWrappers();

    }

    Plugin.prototype.initWrappers = function() {
        this.wrapper = $(this.element).parent('div');
        //$('<h3>').text('Irudia hautatu').appendTo(this.wrapper);

        if (this.preselectedItem == true && this.preselectedType == "image") {
            this.drawPreselectedItem();
        }

        if (this.showAvatars == true) {
            this.drawAvatarWrapper();
            this.drawImages();
        }

        if (this.selector == true) {
            this.drawUploadWrapper();
        }
    };

    Plugin.prototype.drawPreselectedItem = function () {

        var self = this;
        this.preselectedWrapper = $('<div>').attr('id', 'preselected').appendTo(this.wrapper);

        if (this.isProfileImg == true) {
            console.info(this.isProfileImg);
            var url = this.options.baseUrl + this.options.profilePreviewUrl + this.preselectedPath;
        } else {
            var url = this.options.baseUrl + this.options.imagePreviewUrl + this.preselectedPath;
        }

        this.setFilePath(this.preselectedPath);
        $(this.element).val("image");
        this.preselectedImg = $('<img>').attr({
                'id' : 'preselectedImg',
                'width' : 150,
                'height' : 150,
                'src' : url
            }).appendTo(this.preselectedWrapper);

        $('<button>')
            .attr({
                'type' : 'button',
                'class' : 'btn btn-primary'
            })
            .text('Aldatu')
            .appendTo(this.preselectedWrapper)
            .on('click', function(e){

                e.preventDefault();
                self.preselectedWrapper.slideUp();

                if (self.showAvatar == true) {
                    self.avatarWrapper.slideDown();
                } else {

                    if (self.imageWrapper == undefined) {
                        self.imageWrapper = $('<div>').attr('id','newImage').appendTo(self.wrapper);
                        $("#avatarWrapper").slideDown();
                    }

                    self.imageWrapper.slideDown();

                }
            });
    }

    Plugin.prototype.drawAvatarWrapper = function() {
        this.avatarWrapper = $('<div>').attr('id', 'avatarWrapper').appendTo(this.wrapper);
        this.avatarSelected = $('<input>')
            .attr({
                'id' : 'avatarId',
                'name' : 'avatarId',
                'type' : 'hidden'
            }).appendTo(this.wrapper);

        if (this.preselectedItem == true && this.preselectedType == 'image') {
            this.avatarWrapper.hide();
        }
    };

    Plugin.prototype.drawUploadWrapper = function() {
        var self = this;
        this.imageWrapper = $('<div>').attr('id','newImage').appendTo(this.wrapper);
        if (this.showAvatars == true || this.preselectedItem == true) {
            this.imageWrapper.hide();
        }

        this.imageWrapper.html('');
        if (this.preselectedItem == true && this.preselectedType == 'image') {
            $('<button>')
            .attr({
                'type' : 'button',
                'class' : 'btn btn-primary'
            })
            .text('Aurrekoa erabili')
            .appendTo(this.imageWrapper)
            .on('click', function(e){
                e.preventDefault();
                self.imageWrapper.slideUp();
                self.preselectedWrapper.slideDown();
            });
        }
        this.fileInput = $('<input type="file" />')
            .attr('id','showUpload')
            .attr('class', 'form-control')
            .attr('placeholder', 'Irudia')
            .appendTo(this.imageWrapper);

        this.fileUploadTrigger = $('<button>')
            .text("Irudia igo")
            .attr({
                'type' : 'button',
                'class' : 'btn btn-info'
            }).appendTo(this.imageWrapper);

        this.fileUploadTrigger.on('click', function(e){
            e.preventDefault();
            self.upload()
        });

        this.previewWrapper = $('<div>').attr('id','previewImage').appendTo(this.imageWrapper);

        if (this.showAvatars == true) {
            this.previewWrapper.hide();
            $('<p>').appendTo(this.imageWrapper);
            $('<button>')
                .text('Albumetik bat hautatu')
                .attr({
                    'id': 'showAvatars',
                    'type' : 'button',
                    'class' : 'btn btn-primary'
                })
                .css('cursor','pointer')
                .appendTo(this.imageWrapper);
        }

    };

    Plugin.prototype.drawImages = function () {
        var self = this;
        var url = this.options.baseUrl + this.options.avatarListUrl + '?format=json';
        $.getJSON(url, function(data) {
            if (data.images.length > 0) {
                if (self.preselectedItem == true && self.preselectedType == 'image') {
                    $('<button>')
                        .text('Aurrekoa erabili')
                        .attr({
                            'type' : 'button',
                            'class' : 'btn btn-primary'
                        })
                        .appendTo(self.avatarWrapper)
                        .on('click', function(e){
                            e.preventDefault();
                            self.preselectedWrapper.slideDown();
                            self.avatarWrapper.slideUp();
                        });
                }
                self.avatarWrapper.append($('<p>').text("Profilaren irudia hautatu"));
                $.each(data.images, function(i,item){
                    self.avatarWrapper.append(
                        $('<img>').attr({
                            'id' : item.id,
                            'src': data.baseUrl + item.id,
                            'height' : 80,
                            'width' : 80
                        }).css('cursor', 'pointer')
                    );
                });
                if (self.selector == true) {
                    $('<p>').appendTo(self.avatarWrapper);
                    $('<button>')
                    .text("Zurea igo")
                    .attr({
                        'id' : 'showUpload',
                        'type' : 'button',
                        'class' : 'btn btn-primary'
                    })
                    .css('cursor', 'pointer')
                    .appendTo(self.avatarWrapper);
                }
                self.bindImageChooser();
                if (self.preselectedItem == true && self.preselectedType == 'avatar') {
                    $('img#' + self.preselectedPath, self.avatarWrapper).trigger('click');
                }
            }
            if (self.selector == true) {
                self.bindWrapperChanger();
            }
        });
    };

    Plugin.prototype.bindImageChooser = function () {
        var self = this;
        this.avatarWrapper.find('img').each(function(i,item){
            $(item).on('click', function(){
                var id = $(item).attr('id');
                self.setActiveAvatar(id);
            });
        });

        if (this.preselectedItem == false) {
            this.avatarWrapper.find('img:eq(0)').trigger('click');
        }
    };

    Plugin.prototype.setActiveAvatar = function (id) {
        this.$el.val('avatar');
        this.avatarSelected.val(id);
        this.avatarWrapper.find('img').each(function(i,item){
            $(item).removeClass('activeAvatar');
        });
        $('img#' + id, this.avatarWrapper).addClass('activeAvatar');
    };

    Plugin.prototype.bindWrapperChanger = function() {
        var self = this;
        $('#showUpload', this.wrapper).on('click', function(e){
            e.preventDefault();
            self.avatarWrapper.slideUp();
            self.imageWrapper.slideDown();
            $(self.element).val("image");
        });
        $('#showAvatars', this.wrapper).on('click', function(e){
            e.preventDefault();
            self.avatarWrapper.slideDown();
            self.imageWrapper.slideUp();
            $(self.element).val("avatar");
        });
    };

    Plugin.prototype.upload = function() {
        var self = this;
        var uploadUrl = this.options.baseUrl + this.options.imageUploadUrl + '?format=json';
        var data = new FormData();
        data.append('irudia', $(this.fileInput)[0].files[0])

        $.ajax({
            type: 'POST',
            data: data,
            url: uploadUrl,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                if (data.irudiaUrl) {
                    self.showTempImage(data.irudiaUrl);
                }
            }
        });
    };

    Plugin.prototype.showTempImage = function(filePath) {
        var self = this;
        this.previewWrapper.html('');
        var imageUrl = this.options.baseUrl + this.options.imagePreviewUrl + filePath;
        this.setFilePath(filePath);
        $('<p>')
            .attr('id', 'previewHelp')
            .text("Hautatu iruditik nahi duzun zatia.")
            .appendTo(this.previewWrapper);

        $('<img>')
            .attr({
                'id' : 'jcropMe',
                'src' : imageUrl
        })
        .appendTo(this.previewWrapper)
        .Jcrop({
            onChange: this.showPreview.bind(this),
            onSelect: this.showPreview.bind(this),
            boxWidth: 500,
            aspectRatio: parseInt(this.options.aspectRatio)
        });
        this.drawPreviewNodes(imageUrl);
    };

    Plugin.prototype.drawPreviewNodes = function (imageUrl) {
        if (this.addThumbnail == true) {
            var self = this;
            var thumbnail = $('<div>')
            .css({
                    'width' : 150,
                    'height' : 150,
                    'overflow' : 'hidden'
                }).appendTo(this.previewWrapper);

            $('<img>')
                .on("load",function() {
                    self.options.thumbWidth = $(this).width();
                    self.options.thumbHeight = $(this).height();
                }).attr({
                    'id' : 'preview',
                    'src' : imageUrl,
                    'class': 'jcrop'
                })
                .appendTo(thumbnail);

            $('<button>')
                .text('Eginda')
                .attr({
                    'type' : 'button',
                    'class' : 'btn btn-success'
                })
                .appendTo(this.previewWrapper)
                .on('click', function(e){
                    e.preventDefault();
                    $('.jcrop-holder', self.previewWrapper).hide();
                    $('button', self.previewWrapper).hide();
                    $('#previewHelp', self.previewWrapper).hide();
                    $('input[type="submit"]', self.wrapper.parents('form')).show();
                    $(self.element).val("image");
                });

            $('<button>')
                .text('Ezeztatu')
                .attr({
                    'type' : 'button',
                    'class' : 'btn btn-danger'
                })
                .appendTo(this.previewWrapper)
                .on('click', function(e){
                    e.preventDefault();
                    self.previewWrapper.slideUp();
                    self.imageWrapper.slideDown();
                    $('input[type="submit"]', self.wrapper.parents('form')).show();
                });
            this.previewWrapper.slideDown();
        }
    };

    Plugin.prototype.showPreview = function(coords) {
        if (this.addThumbnail == true) {
            var rx = 150 / coords.w;
            var ry = 150 / coords.h;
            $('#preview', this.previewWrapper).css({
                width: Math.round(rx * this.options.thumbWidth) + 'px',
                height: Math.round(ry * this.options.thumbHeight) + 'px',
                marginLeft: '-' + Math.round(rx * coords.x) + 'px',
                marginTop: '-' + Math.round(ry * coords.y) + 'px'
            });
        }

        this.updateCoords(coords);
    };

    Plugin.prototype.setFilePath = function (filePath) {
        if (!$('input#imagePath', this.wrapper).length > 0) {
            $('<input>')
                .attr({
                    'type' : 'hidden',
                    'id' : 'imagePath',
                    'name' : 'imagePath',
                    'value' : filePath
                }).appendTo(this.wrapper);
        } else {
            $('input#imagePath', this.wrapper).attr('value', filePath);
        }
    }

    Plugin.prototype.updateCoords = function(coords) {
        if (!$('#x', this.wrapper).length > 0) {
            $('<input>')
                .attr({
                    'id' : 'x',
                    'name' : 'x',
                    'type' : 'hidden'
                }).appendTo(this.wrapper);
            $('<input>')
                .attr({
                    'id' : 'y',
                    'name' : 'y',
                    'type' : 'hidden'
                }).appendTo(this.wrapper);
            $('<input>')
                .attr({
                    'id' : 'w',
                    'name' : 'w',
                    'type' : 'hidden'
                }).appendTo(this.wrapper);
            $('<input>')
                .attr({
                    'id' : 'h',
                    'name' : 'h',
                    'type' : 'hidden'
                }).appendTo(this.wrapper);
        }

        $('#x', this.wrapper).val(coords.x);
        $('#y', this.wrapper).val(coords.y);
        $('#w', this.wrapper).val(coords.w);
        $('#h', this.wrapper).val(coords.h);
    };

    Plugin.prototype.getPluginOptions = function () {
        this.preselectedItem = false;
        if (typeof(this.$el.attr('data-preselected-image')) != "undefined") {
            this.preselectedItem = true;
            if (this.$el.data('preselected-type') == 'avatar') {
                this.preselectedType = "avatar";
                this.preselectedPath = this.$el.data('preselected-avatar');
            } else if (this.$el.data('preselected-type') == 'image') {
                this.preselectedType = "image";
                this.preselectedPath = this.$el.data('preselected-path');
                this.isProfileImg = this.$el.data('profile-image') ? this.$el.data('profile-image') : false;
            }
        }

        this.selector = true;
        if (typeof(this.$el.data('selector')) != "undefined") {
            if (this.$el.data('selector') == 1) {
                this.selector = true;
            } else {
                this.selector = false;
            }
        }

        this.showAvatars = true;
        if (typeof(this.$el.data('show-default')) != "undefined") {
            if (this.$el.data('show-default') == 1) {
                this.showAvatars = true;
            } else {
                this.showAvatars = false;
            }
        }

        this.addThumbnail = true;
        if (typeof(this.$el.data('show-preview')) != "undefined") {
            if (this.$el.data('show-preview') == 1) {
                this.addThumbnail = true;
            } else {
                this.addThumbnail = true;
            }
        }

        this.options.aspectRatio = 1;
        if (typeof(this.$el.data('aspect-ratio')) != "undefined") {
            if (this.$el.data('aspect-ratio') == 1) {
                this.options.aspectRatio = 1;
            } else {
                this.options.aspectRatio = 0;
            }
        }
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
