<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Produk Bakpia</title>
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

        <h4 class="text-center mt-5" style="text-decoration:underline;">LAPORAN PRODUK BAKPIA</h4>
        <?php if (isset($_GET['awal']) && isset($_GET['akhir'])) { ?>
        <h6 class="text-center"><?= $_GET['awal'] . ' / ' . $_GET['akhir'] ?></h6>
        <?php } ?>
        <hr>
        <table id="mytable" class="table table-bordered table-md">
            <thead>

                <tr>
                    <th class="text-center">Nama Produk</th>
                    <th class="text-center">Kategori</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Berat</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">Foto</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($produks as $produk)
                    <tr>
                        <td class="text-center">{{ $produk->nama_produk }}</td>
                        <td class="text-center">{{ $produk->kategori->nama_kategori }}</td>
                        <td class="text-center">{{ currency_IDR($produk->harga) }}</td>
                        <td class="text-center">{{ $produk->berat }}</td>
                        <td class="text-center">{{ $produk->keterangan }}</td>
                        <td class="text-center">
                            <a target="_blank" href="{{ asset('storage/' . $produk->foto) }}">
                                <img src="{{ asset('storage/' . $produk->foto) }}" alt="Foto Produk"
                                    style="width:150px;height:130px;">
                            </a>
                        </td>

                    </tr>
                @endforeach
            </tbody>


        </table>


</body>

</html>
