<?php
// Class paling atas (level 1): Tontonan
// Berisi hal paling umum yang dimiliki SEGALA jenis tontonan di bioskop,
// belum tentu berupa film (bisa saja nanti dikembangkan jadi Iklan, Trailer, dsb).
// Konsepnya sama persis dengan Tontonan pada versi C++ dan Python.
class Tontonan {
    protected $id;
    protected $judul;
    protected $durasi;   // dalam menit

    // Constructor (kalau dipanggil new Tontonan() tanpa isi, atribut memakai nilai awal di bawah)
    public function __construct($id = 0, $judul = "", $durasi = 0) {
        $this->id = $id;
        $this->judul = $judul;
        $this->durasi = $durasi;
    }

    // Destructor: tidak ada yang perlu dibersihkan di class ini
    public function __destruct() {
    }

    // ===== Getter =====
    public function getId() { return $this->id; }
    public function getJudul() { return $this->judul; }
    public function getDurasi() { return $this->durasi; }

    // ===== Setter =====
    public function setId($id) { $this->id = $id; }
    public function setJudul($judul) { $this->judul = $judul; }
    public function setDurasi($durasi) { $this->durasi = $durasi; }
}
