<?php
require_once "Tontonan.php";

// Class level 2: Film
// Film adalah Tontonan yang punya genre, sutradara, dan batasan usia penonton.
// Lewat "extends Tontonan", Film otomatis punya id, judul, durasi, beserta
// getter dan setter-nya, tanpa perlu menulis ulang.
//
// Atribut "gambar" (poster) diletakkan di sini, bukan di Tontonan maupun
// FilmFranchise, karena: Tontonan masih terlalu umum (belum tentu semua jenis
// tontonan punya poster, misalnya Iklan/Trailer belum tentu perlu poster),
// sedangkan setiap Film pasti punya poster untuk ditampilkan ke penonton,
// baik dia bagian dari franchise atau bukan.
class Film extends Tontonan {
    protected $genre;
    protected $sutradara;
    protected $ratingUsia;   // contoh: "SU", "13+", "17+", "21+"
    protected $gambar;       // path file poster, contoh: image/film_abc123.jpg

    // Constructor: bagian id, judul, durasi diteruskan ke constructor Tontonan
    public function __construct($id = 0, $judul = "", $durasi = 0, $genre = "", $sutradara = "", $ratingUsia = "", $gambar = "") {
        parent::__construct($id, $judul, $durasi);
        $this->genre = $genre;
        $this->sutradara = $sutradara;
        $this->ratingUsia = $ratingUsia;
        $this->gambar = $gambar;
    }

    public function __destruct() {
    }

    // ===== Getter =====
    public function getGenre() { return $this->genre; }
    public function getSutradara() { return $this->sutradara; }
    public function getRatingUsia() { return $this->ratingUsia; }
    public function getGambar() { return $this->gambar; }

    // ===== Setter =====
    public function setGenre($genre) { $this->genre = $genre; }
    public function setSutradara($sutradara) { $this->sutradara = $sutradara; }
    public function setRatingUsia($ratingUsia) { $this->ratingUsia = $ratingUsia; }
    public function setGambar($gambar) { $this->gambar = $gambar; }
}
