$(function () {
    getNotification();

    $(".penilaian").mouseover(function () {
        resetBintang();
        let currentPosition = parseInt($(this).data("index"));

        for (var i = 0; i <= currentPosition; i++) {
            $(".penilaian:eq(" + i + ")").css("color", "gold");
        }

        $("#rating").val(currentPosition + 1);
    });

    // _token: csrftoken,
    $(".pesananselesai").click(function (e) {
        const idPemesanan = $(this).data("id");

        fetch(`/pemesanan/selesai/${idPemesanan}`, {
            method: "PUT",
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrftoken,
            },
        })
            .then((Response) => Response.json())
            .then((Response) => {
                Swal.fire({
                    icon: Response.status,
                    showConfirmButton: false,
                    title: Response.message,
                    timer: 900,
                }).then((res) => {
                    location.reload();
                });
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
    if ($('input[name="tanggal"]').length) {
        $('input[name="tanggal"]').daterangepicker({
            singleDatePicker: true,
            startDate: moment().add(6, "days"),
            minDate: moment().add(6, "days"),
        });
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
                form.append("total", res.data.total);
                form.append("ongkir", res.data.ongkir);
                form.append("estimasi", res.data.estimasi);
                $("#exampleModalCenter").modal("toggle");
                if (res.status == 200) {
                    midPay(res.data.token, form);
                }
            },
            statusCode: {
                422: function (data) {
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

    $(".review").click(function (e) {
        const idDetailPemesanan = $(this).data("id");
        $("#id_detail_pemesanan").val(idDetailPemesanan);
    });
});

function resetBintang() {
    $(".penilaian").css("color", "black");
}

function midPay(token, form) {
    window.snap.pay(token, {
        onPending: function (result) {
            /* You may add your own implementation here */
            // Callback to insert data pemesanan
            form.append("payment", JSON.stringify(result));
            insertTransaksi(form);
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
    if (jumlah <= 50) {
        $.ajax({
            method: "PUT",
            header: {
                Accept: "Application/Json",
            },
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
            statusCode: {
                404: function (data) {
                    Swal.fire({
                        icon: "info",
                        showConfirmButton: true,
                        title: "Terjadi Kesalahan",
                        text: "Silahkan coba beberapa saat lagi",
                        confirmButtonText: "Oke",
                    }).then(function () {
                        location.reload();
                    });
                },
            },
        });
    }
}

function getNotification() {
    const request = new Request("/pemesanan/notifikasi", {
        method: "GET",
        header: {
            Accept: "Application/Json",
        },
    });

    fetch(request)
        .then((Response) => Response.json())
        .then((Response) => {
            const notifLengt = Response.data.length;
            if (notifLengt) {
                $("#sub-notification").empty();
                $(".notification-bell").html(notifLengt);
                Response.data.forEach((value, index) => {
                    const status = getStatus(value.status);
                    const el = `<li><a href="/pemesanan/detail/${value.id_pemesanan}" data-pemesanan="${value.id_pemesanan}" class="notification-unread">Pesanan <b>${value.id_pemesanan}</b> ${status}</a></li>`;
                    $("#sub-notification").append(el);
                });
            }
        });
}

function getStatus(status) {
    if (status == 0) return "berhasil dilakukan silahkan lakukan pembayaran";
    if (status == 1)
        return "sudah melakukan pembayaran. Pesanan akan segera diprosess";
    if (status == 2) return "sedang dalam pembuatan";
    if (status == 3) return "sudah dikirim";
}
