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

$(function () {
    if ($('input[name="tanggal"]').length) {
        $('input[name="tanggal"]').daterangepicker(
            {
                singleDatePicker: true,
                startDate: moment().add(2, "days"),
                minDate: moment().add(2, "days"),
            },
            function (start, end, label) {
                var years = moment().diff(start, "years");
                alert("You are " + years + " years old!");
            }
        );
    }

    if ($("#provinsi").length) {
        //Provinsi Onkgir

        $.ajax({
            method: "GET",
            url: "/ongkir/provinsi",
            dataType: "JSON",
            beforeSend: (fn) => {},
            success: (res) => {
                for (let ongkir of res) {
                    $("#provinsiongkir").append(
                        `<option value="${ongkir.province_id}" selected>${ongkir.province}</option>`
                    );
                }
                $("#provinsiongkir").val("0");
                $("#provinsiongkir").niceSelect("update");
            },
        });
        //Kabupaten Onkgir
        $("#provinsiongkir").change(function (e) {
            let provinsi = $("#provinsiongkir option:selected");
            const namaprovinsi = provinsi.html();
            const idprovinsi = provinsi.val();
            if (idprovinsi !== "0") {
                $.ajax({
                    method: "POST",
                    data: {
                        _token: csrftoken,
                        idprovinsi: idprovinsi,
                    },
                    url: "/ongkir/kabupaten",
                    dataType: "JSON",
                    beforeSend: (fn) => {
                        refreshSelect("kabupatenongkir", "Tunggu Sebentar");
                    },
                    success: (res) => {
                        refreshSelect("kabupatenongkir", "- Pilih Kabupaten -");
                        for (let ongkir of res) {
                            $("#kabupatenongkir").append(
                                `<option value="${ongkir.city_id}" selected>${ongkir.city_name}</option>`
                            );
                        }
                        $("#kabupatenongkir").val("0");
                        $("#kabupatenongkir").niceSelect("update");
                        $("#provinsi").val(namaprovinsi);
                    },
                });
            }
        });

        //Kabupaten Onkgir
        $("#kabupatenongkir").change(function (e) {
            let kabupaten = $("#kabupatenongkir option:selected");
            const namakabupaten = kabupaten.html();
            const idkabupaten = kabupaten.val();
            const berat = $("#berat").val();
            if (idkabupaten !== "0") {
                $.ajax({
                    method: "POST",
                    data: {
                        _token: csrftoken,
                        idkabupaten: idkabupaten,
                        berat,
                    },
                    url: "/ongkir/ongkir",
                    dataType: "JSON",
                    beforeSend: (fn) => {
                        refreshSelect("pengiriman", "Tunggu Sebentar");
                    },
                    success: (res) => {
                        refreshSelect("pengiriman", "- Pilih Pengiriman -");

                        for (const ongkir of res) {
                            let code = ongkir.code;
                            for (const pengiriman of ongkir.costs) {
                                let harga = pengiriman.cost[0].value;
                                let estimasi = pengiriman.cost[0].etd;
                                let service = pengiriman.service;
                                let el = `<option data-harga="${harga}" data-estimasi="${estimasi}" value="${code} - ${service}">${code} - ${service} - ${rupiah(
                                    harga
                                )}  - ${estimasi} </option>`;
                                $("#pengiriman").append(el);
                            }
                        }

                        $("#pengiriman").val("0");
                        $("#pengiriman").niceSelect("update");
                        $("#kabupaten").val(namakabupaten);
                    },
                });
            }
        });

        $("#pengiriman").change(function (e) {
            let estimasi = $("#pengiriman option:selected").data("estimasi");
            let pengiriman = $("#pengiriman option:selected").val();
            let codeAndService = pengiriman.split("-");
            let code = codeAndService[0].trim();
            let service = codeAndService[1].trim();
            let harga = parseFloat(
                $("#pengiriman option:selected").data("harga")
            );
            let total = parseFloat($("#total").val());
            let grandtotal = harga + total;
            $(".ongkir").html(rupiah(grandtotal));
            $(".grandtotal").html(rupiah(grandtotal));
            $("#service").val(service);
            $("#code").val(code);
        });
    }

    $("#bayar").click(function (e) {
        e.preventDefault();
        let formPengiriman = document.getElementById("formpengiriman");
        let form = new FormData(formPengiriman);

        $.ajax({
            method: "POST",
            url: "/checkout/pay",
            data: form,
            cache: false,
            processData: false,
            contentType: false,
            dataType: "JSON",
            beforeSend: (fn) => {
                $("#exampleModalCenter").modal("toggle");
            },
            success: (res) => {
                form.append("total", res.total);
                form.append("ongkir", res.ongkir);
                form.append("estimasi", res.estimasi);
                $("#exampleModalCenter").modal("toggle");
                if (res.status == 400) {
                    midPay(res.token, form);
                }
            },
            statusCode: {
                422: function (data) {
                    // console.log(data.responseJSON.errors);
                    let ul = document.createElement("ul");

                    $.each(data.responseJSON.errors, function (key, value) {
                        // Set errors on inputs
                        var li = document.createElement("li");
                        li.appendChild(document.createTextNode(value[0]));
                        ul.appendChild(li);
                    });

                    Swal.fire({
                        icon: "info",
                        showConfirmButton: true,
                        title: "Checkout gagal",
                        html: ul,
                        confirmButtonText: "Oke",
                    });
                },
            },
        });
    });

    $.ajax({
        method: "GET",
        url: "/keranjang/jumlah",
        dataType: "JSON",
        success: (res) => {
            $("#jumlahkeranjang").remove();
            if (res.jumlah) {
                let el = $(`<span id="jumlakeranjang">${res.jumlah}</span>`);
                $(".containerkeranjang").append(el);
            }
        },
    });
});

function midPay(token, form) {
    window.snap.pay(token, {
        onSuccess: function (result) {
            /* You may add your own implementation here */
            alert("payment success!");
            console.log(result);
        },
        onPending: function (result) {
            /* You may add your own implementation here */
            // Callback to insert data pemesanan
            form.append("payment", JSON.stringify(result));
            insertTransaksi(form);
        },
        onError: function (result) {
            /* You may add your own implementation here */
            fd.append("payment", JSON.stringify(result));
        },
        onClose: function () {
            /* You may add your own implementation here */
            alert("you closed the popup without finishing the payment");
        },
    });
}

function insertTransaksi(form) {
    $.ajax({
        method: "POST",
        url: "/pemesanan/simpan",
        data: form,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "JSON",
        success: (res) => {
            Swal.fire({
                icon: res.type,
                position: "center",
                timer: 1000,
                showConfirmButton: false,
                title: res.message,
            }).then(function () {
                document.location.href = "/";
            });
        },
    });
}

function refreshSelect(id, pesan) {
    $(`#${id}`)
        .find("option")
        .remove()
        .end()
        .append(`<option value="0">${pesan}</option>`)
        .val("0");
    $("#" + id).niceSelect("update");
}

function updateKeranjang(jumlah, idkeranjang, input) {
    $.ajax({
        method: "PUT",
        data: {
            jumlah,
            idkeranjang,
            _token: csrftoken,
        },
        dataType: "json",
        url: "/keranjang/edit/" + idkeranjang,
        success: (res) => {
            Swal.fire({
                icon: "success",
                position: "bottom-end",
                timer: 1000,
                toast: true,
                showConfirmButton: false,
                title: "Keranjang berhasil diperbarui",
            }).then(function () {
                input.parent().parent().next().html(res.subtotal);
                $("#grandtotal").html(res.grandtotal);
            });
        },
    });
}
