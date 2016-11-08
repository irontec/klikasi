function showLoader() {
    $("#loader").show()
}

function hideLoader() {
    $("#loader").hide()
}
showLoader(),
    function(a) {
        jQuery.support.placeholder = function() {
            var a = document.createElement("input");
            return "placeholder" in a
        }(), a(document).ready(function() {
            var b = a("header:eq(0)").height() + 5;
            a("header:eq(0)").attr("style", "height:" + b + "px!important");
            var c = a("header:eq(0) nav:eq(1)").height(),
                d = a("header:eq(0) .navbar").width(),
                e = d > 758,
                f = a("li.bilatu:visible");
            a(window).on("resize", function() {
                c = a("header:eq(0) nav:eq(0)").height() + a("header:eq(0) nav:eq(2)").height(), d = a("header:eq(0) .navbar").width(), e = d > 758
            }), a(window).on("scroll", function() {
                a(window).scrollTop() > c ? a("header > div.navbar").hasClass("navbar-fixed-top") || (e ? (a("header > div.navbar").addClass("navbar-fixed-top"), a("nav:lt(-2), #mega-menu > ul").hide(), a("#mega-menu").addClass("hidden-xs").addClass("scroll-menu").removeClass("nav-full"), a("#mega-menu > ul.nav li:eq(0)").removeClass("hide"), a("#mega-menu > ul.nav li:gt(0):lt(-1)").removeClass("col-xs-6"), f.hasClass("open") ? a("nav:eq(0),#mega-menu > ul").show() : a("nav:eq(0),#mega-menu > ul").fadeIn()) : (a("header > div.navbar").addClass("navbar-fixed-top"), a("nav:lt(-2), #mega-menu > ul").hide(), f.hasClass("open") ? a("nav:eq(0),#mega-menu > ul").show() : a("nav:eq(0),#mega-menu > ul").fadeIn())) : a("header > div.navbar").hasClass("navbar-fixed-top") && (a("header > div.navbar").removeClass("navbar-fixed-top"), a("#mega-menu").removeClass("hidden-xs").removeClass("scroll-menu").addClass("nav-full"), a("#mega-menu > ul.nav li:eq(0)").addClass("hide"), a("#mega-menu > ul.nav li:gt(0):lt(-1)").addClass("col-xs-6"), e ? a("nav:lt(-2)").css("display", "block") : a("nav:lt(-2)").attr("style", ""))
            });
            var g = a("#mega-menu li.bilatu form");
            a("#mega-menu a.dropdown-toggle").on("click", function() {
                if (!a(this).parent().hasClass("open")) {
                    var b = g.find("input:eq(0)");
                    setTimeout(function() {
                        b.focus()
                    }, 300)
                }
            }), a("#search-adina").slider({
                tooltip: "hide"
            }).on("slide", function() {
                var b = a(this),
                    c = b.val();
                b.val(c);
                var d = c.split(",");
                g.find(".min-years").text("" == d[0] ? 10 : d[0]), g.find(".max-years").text("" == d[1] ? 25 : d[1])
            }), g.find(".search-formbutton").on("click", "a.iragazi", function(b) {
                b.preventDefault(), b.stopPropagation(), a(this).parents("form").submit()
            }).on("click", "a.refresh", function(b) {
                b.preventDefault(), b.stopPropagation(), a(this).parents("form").get(0).reset()
            }).on("click", "a.angle", function(b) {
                b.preventDefault(), b.stopPropagation();
                var c = g.find("input,select").filter(":gt(0)");
                "none" != a(this).css("transform") && "" != a(this).css("transform") ? c.removeAttr("disabled") : c.attr("disabled", "disabled"), g.find("input,select").filter(":gt(0)"), "" == a(this).attr("style") ? a(this).attr("style", "transform:rotate(180deg); -ms-transform:rotate(180deg); -webkit-transform:rotate(180deg);") : a(this).attr("style", ""), a(this).parents("form").find(".toggle").toggle()
            }), g.find("select[name='searchkategoria[]']").select2(), a("input[name=searchdatefrom],input[name=searchdateto]").datepicker({
                language: "eu",
                format: "yyyy-mm-dd",
                autoclose: "true",
                startDate: "2010-01-01",
                endDate: new Date,
                startView: 2
            }).on("show", function() {
                var b = a(".datepicker");
                a(b.get(1)).css("z-index", 1060), b.click(function() {
                    return !1
                })
            }), a.support.placeholder || a("form").find("input, textarea").placeholder()
        })
    }(jQuery), $(document).on("click", ".mega-menu .dropdown-menu", function(a) {
        a.stopPropagation()
    }), $(document).ready(function() {
        if ($(".carousel").length) {
            var a = document.getElementsByClassName("carousel");
            if (a.length > 0) {
                var b = $(a[0]).find("div.carousel-inner"),
                    c = b.find("div.elem"),
                    d = $(c.get(0)).width() * c.length;
                d > 0 && d < b.width() && b.parent().find(".carousel-control").hide();
                for (var e = 0; e < a.length; e++) Hammer(a[e]).on("dragright", function() {
                    $(this).carousel("prev")
                }), Hammer(a[e]).on("dragleft", function() {
                    $(this).carousel("next")
                })
            }
        }
        $(".tooltip-examples a").tooltip({
            placement: "top"
        }), $window = $(window), $('.scroll-parallax[data-type="background"]').each(function() {
            var a = $(this);
            $(window).scroll(function() {
                var b = -($window.scrollTop() / a.data("speed")),
                    c = "50% " + b + "px";
                a.css({
                    backgroundPosition: c
                })
            })
        })
    }), $(window).load(function() {
        hideLoader(), $("#main-content").addClass("loaded")
    }), $(".datepicker").datepicker();