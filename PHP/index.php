<?php
require_once "FilmFranchise.php";

$bioskop = new FilmFranchise();          // object untuk memanggil semua fitur
$daftar = $bioskop->muatData();          // array of object berisi semua film

// ----- Pesan setelah tambah data -----
$pesan = ($_GET["pesan"] ?? "") == "tambah" ? "Data berhasil ditambahkan!" : "";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Film Franchise</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Data Film Franchise</h1>
    <p class="subjudul">Tontonan &rarr; Film &rarr; FilmFranchise</p>

    <?php if ($pesan != "") { ?>
        <div class="alert alert-sukses"><?= htmlspecialchars($pesan) ?></div>
    <?php } ?>

    <div class="toolbar">
        <a href="tambah.php" class="btn btn-utama">+ Tambah Film</a>
    </div>

    <div class="tabel-wrap">
        <table>
            <tr>
                <th>ID</th>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Durasi</th>
                <th>Genre</th>
                <th>Sutradara</th>
                <th>Rating</th>
                <th>Jilid</th>
                <th>Franchise</th>
                <th>Judul Selanjutnya</th>
            </tr>

            <?php if (count($daftar) == 0) { ?>
                <tr>
                    <td colspan="10" class="kosong">Belum ada data film.</td>
                </tr>
            <?php } ?>

            <?php foreach ($daftar as $film) { ?>
                <tr>
                    <td><?= $film->getId() ?></td>
                    <td><img src="<?= htmlspecialchars($film->getGambar()) ?>" alt="Poster <?= htmlspecialchars($film->getJudul()) ?>" class="poster"></td>
                    <td><?= htmlspecialchars($film->getJudul()) ?></td>
                    <td><?= $film->getDurasi() ?> menit</td>
                    <td><?= htmlspecialchars($film->getGenre()) ?></td>
                    <td><?= htmlspecialchars($film->getSutradara()) ?></td>
                    <td><?= htmlspecialchars($film->getRatingUsia()) ?></td>
                    <td><?= $film->getJilidKe() ?></td>
                    <td><?= htmlspecialchars($film->getNamaFranchise()) ?></td>
                    <td><?= htmlspecialchars($film->getJudulSelanjutnya()) ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
</body>
</html>
