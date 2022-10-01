<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>B4T | Peminjaman</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  </head>
  <body>
<div class="container-fluid">
  <div class="row">
    <main class="col-md-9 col-lg-10 px-md-5">
        <table class="mb-3">
            <tr>
                <td><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/22/Logo_of_the_Ministry_of_Industries_of_the_Republic_of_Indonesia.svg/1280px-Logo_of_the_Ministry_of_Industries_of_the_Republic_of_Indonesia.svg.png" style="max-height: 72px; overflow:hidden; margin-right: 40px"></td>
                <td style="text-align: center; font-family: serif">
                    <p class="mb-0" style="font-size: 15px">BADAN STANDARISASI DAN KEBIJAKAN JASA INDUSTRI</p>
                    <p class="mb-0 fw-bold" style="font-size: 19px">BALAI BESAR BAHAN DAN BARANG TEKNIK</p>
                    <p class="mb-0" style="font-size: 14px">Jl. Sangkuriang No. 14 Bandung 40135 JAWA BARAT - INDONESIA</p>
                    <p class="mb-0" style="font-size: 14px">Telp. 022-2504088, 2510682, 2504828 Fax. 022-2502027</p>
                    <p class="mb-0" style="font-size: 14px">Website : <u>www.b4t.go.id</u> &nbsp;&nbsp;&nbsp;&nbsp;E-mail : <u>b4t@b4t.go.id</u></p>
                </td>
            </tr>
            <tr>
                <td colspan="2"><hr class="border border-danger border-2 opacity-50"></td>
            </tr>
            <tr style="text-align: center; font-family: serif">
                <td colspan="2" style="font-size: 16px"><u>BERITA ACARA PINJAM PAKAI BARANG</u></td>
            </tr>
        </table>

        <table class="mb-3" style="font-family: serif">
            <tr>
                <td>Yang bertanda tangan dibawah ini</td>
                <td>:</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
                <td>:</td>
                <td>{{ auth()->user()->name }}</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nomor ID</td>
                <td>:</td>
                <td>{{ auth()->user()->no_id }}</td>
            </tr>
            <tr>
                <td>Selanjutnya disebut Pihak Pertama</td>
            </tr>
        </table>

        <table style="font-family: serif">
            <tr>
                <td>Pihak Pertama menyerahkan sebuah barang milik Balai Besar Bahan Dan Barang Teknik dalam keadaan baik kepada :</td>
            </tr>
        </table>

        <table class="mb-3" style="font-family: serif">
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
                <td>:</td>
                <td>{{ $pinjam->name_user }}</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nomor ID</td>
                <td>:</td>
                <td>{{ $pinjam->no_id }}</td>
            </tr>
            <tr>
                <td>Selanjutnya disebut Pihak Kedua&nbsp;&nbsp;&nbsp;</td>
            </tr>
        </table>

        <table style="font-family: serif">
            <tr>
                <td>Dengan ini kedua pihak menyatakan sepakat bahwa :</td>
            </tr>
            <tr>
                <td>1. Pihak Pertama telah menyerahkan Barang Inventaris (BMN) berupa barang untuk</td>
            </tr>
        </table>

        <table class="mb-3" style="font-family: serif">
            <tr>
                <td>dipinjam pakai kepada Pihak Kedua.</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama Barang</td>
                <td>:</td>
                <td>{{ $pinjam->name_barang }}</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kode Barang</td>
                <td>:</td>
                <td>{{ $pinjam->kode_barang }}</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kondisi</td>
                <td>:</td>
                <td>Baik</td>
            </tr>
        </table>

        <table class="mb-3" style="font-family: serif">
            <tr>
                <td>2. Dengan telah diserahkannya barang tersebut diatas oleh Pihak Pertama kepada Pihak Kedua, maka selanjutnya pengelolaan barang dimaksud menjadi tanggung jawab Pihak Kedua.
                </td>
            </tr>
            <tr>
                <td>3. Pihak Kedua wajib menyerahkan barang pinjam pakai bilamana tidak menjabat lagi/pindah kerja/mengundurkan diri dari PNS/pensiun, kepada Pihak Pertama/Sub.Bagian Keuangan yang kemudian melaporkan kepada BMN.</td>
            </tr>
        </table>

        <table class="mb-5" style="font-family: serif">
            <tr>
                <td>Demikian Berita Acara ini dibuat sesuai dengan keadaan yang sebenarnya untuk dipergunakan<br> sebagaimana mestinya.</td>
            </tr>
        </table>

        <table style="font-family: serif">
            <tr>
                <td style="padding-left: 90px">Pihak Pertama<br><br><br><br><br><p style="text-align: center">{{ auth()->user()->name }}</p></td>
                <td style="padding-left: 320px">Pihak Kedua<br><br><br><br><br><p style="text-align: center">{{ $pinjam->name_user }}</p></td>
            </tr>
        </table>
    </main>
  </div>
</div>


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="/js/dashboard.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

  </body>
</html>