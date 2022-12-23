<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notification Email CV Asia Teknik</title>
</head>
<body>
    <h1>CV ASia Teknik</h1>
    <h2>Hi,{{$name}}</h2>
    <p class="lead">Terima kasih telah menggunakan jasa service dari CV Asia Teknik,kepuasan ada ialah yang utama.
         berikut kami lampirkan data terkait service anda.
    </p>

    <div class="userdetail">
        <table>
            <tr>
                <h3>No invoice : {{$id}}</h3>
                <h3>Nama : {{$name}}</h3>
                <h3>Status : Selesai</h3>
                <h3>Waktu Pengerjaan : {{$tanggal}}</h3>
            </tr>

        </table>
    </div>
</body>
</html>
