/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";
const csrftoken = $('meta[name="_token"]').attr("content");

jQuery.extend(jQuery.validator.messages, {
    required: "Field tidak boleh kosong.",
    remote: "Please fix this field.",
    email: "Please enter a valid email address.",
    url: "Please enter a valid URL.",
    date: "Please enter a valid date.",
    dateISO: "Please enter a valid date (ISO).",
    number: "Field hanya boleh diisi dengan angka.",
    digits: "Hanya boleh angka.",
    creditcard: "Please enter a valid credit card number.",
    equalTo: "Please enter the same value again.",
    accept: "Please enter a value with a valid extension.",
    maxlength: jQuery.validator.format(
        "Please enter no more than {0} characters."
    ),
    minlength: jQuery.validator.format("Mohon masukan {0} angka."),
    rangelength: jQuery.validator.format(
        "Please enter a value between {0} and {1} characters long."
    ),
    range: jQuery.validator.format("Please enter a value between {0} and {1}."),
    max: jQuery.validator.format("Angka harus lebih kecil dari {0}."),
    min: jQuery.validator.format("Angka harus lebih besar dari {0}."),
});

jQuery.validator.addMethod(
    "lettersonly",
    function (value, element) {
        return this.optional(element) || /^[A-Z a-z /S]+$/g.test(value);
    },
    "Tidak boleh angka"
);

$(function () {
    $(".resi").click(function (e) {
        let idpemesanan = $(this).data("id");
        $("#id_pemesanan").val(idpemesanan);
        $("#formkirimresi").attr(
            "action",
            `/admin/pemesanan/kirimresi/${idpemesanan}`
        );
    });

    $(".pembuatan").click(function (e) {
        let idpemesanan = $(this).data("id");
        Swal.fire({
            title: "Ubah status menjadi pembuatan?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "PUT",
                    data: {
                        idpemesanan,
                        _token: csrftoken,
                    },
                    url: "/admin/pemesanan/updatepembuatan/" + idpemesanan,
                    dataType: "JSON",
                    success: (res) => {
                        Swal.fire({
                            icon: res.type,
                            title: res.message,
                            showConfirmButton: false,
                            timer: 1000,
                        }).then(function (e) {
                            location.reload();
                        });
                    },
                });
            }
        });
    });

    $(".button-delete").on("click", function (e) {
        e.preventDefault();
        let id = $(this).data("id");
        Swal.fire({
            title: "Are you sure ?",
            text: "You won't be able to revert this !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).parent().submit();
            }
        });
    });

    $("#formadmin").validate({
        rules: {
            name: {
                required: true,
                lettersonly: true,
            },
        },

        highlight: (element, errorClass, validClass) => {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid").addClass("is-valid");
        },
    });

    $("#mytable").DataTable();
});

function editAdmin(idadmin) {
    $.ajax({
        method: "GET",
        url: `/admin/users/${idadmin}`,
        dataType: "JSON",
        success: (res) => {
            $("#name").val(res.name);
            $("#email").val(res.email);
            $("#role").val(res.role);
            $("#formadmin").attr("action", `/admin/users/${idadmin}`);
        },
    });
}

function editProduk(idproduk) {
    $.ajax({
        method: "GET",
        url: `/admin/produk/${idproduk}}`,
        dataType: "JSON",
        success: (res) => {
            $("#nama_produk").val(res.nama_produk);
            $("#harga").val(res.harga);
            $("#berat").val(res.berat);
            $("#id_kategori").val(res.id_kategori);
            $("#keterangan").html(res.keterangan);
            $(".img-preview").attr("src", `/storage/${res.foto}`);
            $("#formproduk").attr("action", `/admin/produk/${idproduk}`);
        },
    });
}

function editKategori(idkategori) {
    $.ajax({
        method: "GET",
        url: `/admin/kategori/${idkategori}}`,
        dataType: "JSON",
        success: (res) => {
            $("#nama_kategori").val(res.nama_kategori);
            $("#formkategori").attr("action", `/admin/kategori/${idkategori}`);
        },
    });
}

function previewImage() {
    const image = document.getElementById("image");
    const imgPreview = document.querySelector(".img-preview");

    imgPreview.style.display = "block";
    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    };
}
