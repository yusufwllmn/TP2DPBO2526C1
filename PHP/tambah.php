<?php
require_once "FilmFranchise.php";

$bioskop = new FilmFranchise();
$daftar = $bioskop->muatData();
$error = [];

// Kalau form dikirim: validasi dan simpan lewat method tambahData
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = $bioskop->tambahData($daftar, $_POST, $_FILES["gambar"] ?? null);

    if (count($error) == 0) {
        header("Location: index.php?pesan=tambah");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Film</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container container-form">
    <h1>Tambah Film</h1>

    <?php if (count($error) > 0) { ?>
        <div class="alert alert-error">
            <?php foreach ($error as $pesan) { ?>
                <div><?= htmlspecialchars($pesan) ?></div>
            <?php } ?>
        </div>
    <?php } ?>

    <form method="post" action="tambah.php" enctype="multipart/form-data">
        <label for="id">ID</label>
        <input type="number" id="id" name="id" min="1" required value="<?= htmlspecialchars($_POST["id"] ?? "") ?>">

        <label for="judul">Judul</label>
        <input type="text" id="judul" name="judul" required value="<?= htmlspecialchars($_POST["judul"] ?? "") ?>">

        <label for="durasi">Durasi (menit)</label>
        <input type="number" id="durasi" name="durasi" min="1" required value="<?= htmlspecialchars($_POST["durasi"] ?? "") ?>">

        <label for="genre">Genre</label>
        <input type="text" id="genre" name="genre" required value="<?= htmlspecialchars($_POST["genre"] ?? "") ?>">

        <label for="sutradara">Sutradara</label>
        <input type="text" id="sutradara" name="sutradara" required value="<?= htmlspecialchars($_POST["sutradara"] ?? "") ?>">

        <label for="ratingUsia">Rating Usia</label>
        <input type="text" id="ratingUsia" name="ratingUsia" placeholder='contoh: SU, 13+, 17+' required value="<?= htmlspecialchars($_POST["ratingUsia"] ?? "") ?>">

        <label for="jilidKe">Jilid Ke</label>
        <input type="number" id="jilidKe" name="jilidKe" min="1" required value="<?= htmlspecialchars($_POST["jilidKe"] ?? "") ?>">

        <label for="namaFranchise">Nama Franchise</label>
        <input type="text" id="namaFranchise" name="namaFranchise" required value="<?= htmlspecialchars($_POST["namaFranchise"] ?? "") ?>">

        <label for="judulSelanjutnya">Judul Selanjutnya</label>
        <input type="text" id="judulSelanjutnya" name="judulSelanjutnya" placeholder='isi "-" jika belum ada' required value="<?= htmlspecialchars($_POST["judulSelanjutnya"] ?? "") ?>">

        <label for="gambar">Gambar (opsional - kosongkan dulu jika belum ada, nanti bisa dipasang menyusul)</label>
        <input type="file" id="gambar" name="gambar" accept="image/*">

        <div class="form-aksi">
            <button type="submit" class="btn btn-utama">Simpan</button>
            <a href="index.php" class="btn btn-abu">Batal</a>
        </div>
    </form>
</div>
</body>
</html>
