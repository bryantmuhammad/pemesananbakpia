/*  ---------------------------------------------------
    Template Name: Violet 
    Description: Violet ecommerce Html Template
    Author: Colorlib
    Author URI: https://colorlib.com/
    Version: 1.0
    Created: Colorlib
---------------------------------------------------------  */

"use strict";

const csrftoken = $('meta[name="csrf-token"]').attr("content");
const rupiah = (number) => {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
    }).format(number);
};

(function ($) {
    /*------------------
        Preloader
    --------------------*/
    $(window).on("load", function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");

        /*------------------
		    Product filter
	    --------------------*/
        if ($("#product-list").length > 0) {
            var containerEl = document.querySelector("#product-list");
            var mixer = mixitup(containerEl);
        }
    });

    /*------------------
        Background Set
    --------------------*/
    $(".set-bg").each(function () {
        var bg = $(this).data("setbg");
        $(this).css("background-image", "url(" + bg + ")");
    });

    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        appendTo: ".header-section",
        allowParentLinks: true,
        closedSymbol: '<i class="fa fa-angle-right"></i>',
        openedSymbol: '<i class="fa fa-angle-down"></i>',
    });

    /*------------------
		Search model
	--------------------*/
    $(".search-trigger").on("click", function () {
        $(".search-model").fadeIn(400);
    });

    $(".search-close-switch").on("click", function () {
        $(".search-model").fadeOut(400, function () {
            $("#search-input").val("");
        });
    });

    /*------------------
        Carousel Slider
    --------------------*/
    $(".hero-items").owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        items: 1,
        dots: true,
        animateOut: "fadeOut",
        animateIn: "fadeIn",
        navText: [
            '<i class="fa fa-angle-left"></i>',
            '<i class="fa fa-angle-right"></i>',
        ],
        smartSpeed: 1200,
        autoplayHoverPause: true,
        mouseDrag: false,
        autoplay: false,
    });

    /*------------------
        Carousel Slider
    --------------------*/
    $(".logo-items").owlCarousel({
        loop: true,
        nav: false,
        dots: false,
        margin: 40,
        autoplay: true,
        responsive: {
            0: {
                items: 2,
            },
            480: {
                items: 2,
            },
            768: {
                items: 3,
            },
            992: {
                items: 5,
            },
        },
    });

    /*------------------
        Carousel Slider
    --------------------*/
    $(".product-slider").owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        items: 1,
        dots: true,
        autoplay: true,
    });

    /*------------------
        Magnific Popup
    --------------------*/
    $(".pop-up").magnificPopup({
        type: "image",
    });

    /*-------------------
		Sort Select
	--------------------- */
    $(".sort").niceSelect();

    /*-------------------
		Cart Select
	--------------------- */
    $(".cart-select").niceSelect();

    /*-------------------
		Quantity change
	--------------------- */
    var proQty = $(".pro-qty");
    proQty.prepend('<span class="dec qtybtn">-</span>');
    proQty.append('<span class="inc qtybtn">+</span>');
    proQty.on("click", ".qtybtn", function () {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        let max = $button.parent().find("input").attr("max");

        if ($button.hasClass("inc")) {
            var newVal = parseFloat(oldValue) + 1;
            if (newVal > max) newVal = parseFloat(oldValue);
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }

        if ($button.parent().find("input").hasClass("u-keranjang")) {
            let idkeranjang = $button.parent().find("input").data("keranjang");
            updateKeranjang(
                newVal,
                idkeranjang,
                $button.parent().find("input")
            );
        }
        $button.parent().find("input").val(newVal);
    });

    /*-------------------
		Radio Btn
	--------------------- */
    $(".shipping-info .cs-item label").on("click", function () {
        $(".shipping-info .cs-item label").removeClass("active");
        $(this).addClass("active");
    });

    $(".checkout-form .diff-addr label").on("click", function () {
        $(this).toggleClass("active");
    });

    $(".payment-method ul li label").on("click", function () {
        $(this).toggleClass("active");
    });
})(jQuery);
