<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Pemesanan Bakpia</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body onload="window.print();">

    <table>
        <div class="kontain">
            <div class="isi" style="position:relative;">

                <p style="text-align:center"><span style="font-family:Times New Roman,Times,serif">
                        <font size="8">{{ env('NAMA_INSTANSI') }}</font>
                    </span></p>
                <p style="text-align:center"><span style="font-size:15px">{{ env('ALAMAT_INSTANSI') }}</span></p>
            </div>
        </div>

        <hr style="border:1.5px solid black;">

        <h4 class="text-center mt-5" style="text-decoration:underline;">LAPORAN PEMESANAN BAKPIA</h4>
        <?php if (isset($_GET['awal']) && isset($_GET['akhir'])) { ?>
        <h6 class="text-center"><?= $_GET['awal'] . ' / ' . $_GET['akhir'] ?></h6>
        <?php } ?>
        <hr>
        <table id="mytable" class="table table-bordered table-md">
            <thead>
                <tr>
                    <th class="text-center">ID Transaksi</th>
                    <th class="text-center">Customer</th>
                    <th class="text-center">Tanggal Pemesanan</th>
                    <th class="text-center">Tanggal Diperlukan</th>
                    <th class="text-center">Total Harga</th>
                </tr>

            </thead>
            <tbody>
                @php($total = 0)
                @foreach ($pemesanans as $pemesanan)
                    @php($total += $pemesanan->total_harga)
                    <tr>
                        <td class="text-center">{{ $pemesanan->id_pemesanan }}</td>
                        <td class="text-center">{{ $pemesanan->user->name }}</td>
                        <td class="text-center">
                            {{ $pemesanan->tanggal_pemesanan->isoFormat('dddd, D MMMM Y') }}
                        </td>
                        <td class="text-center">
                            {{ $pemesanan->tanggal_diperlukan->isoFormat('dddd, D MMMM Y') }}
                        </td>
                        <td class="text-center">
                            {{ currency_IDR($pemesanan->total_harga) }}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td class="text-center" colspan="4"><b>Total</b></td>
                    <td class="text-center"><b>{{ currency_IDR($total) }}</b></td>
                </tr>
            </tbody>
        </table>


</body>

</html>
