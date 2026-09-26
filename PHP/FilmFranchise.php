<?php
require_once "Film.php";

// Class level 3 (paling bawah): FilmFranchise
// FilmFranchise adalah Film yang merupakan bagian dari sebuah franchise/waralaba,
// sehingga punya info jilid keberapa dan film sesudahnya.
// Lewat "extends Film", FilmFranchise otomatis mewarisi seluruh atribut dari Film
// (genre, sutradara, ratingUsia, gambar) SEKALIGUS dari Tontonan (id, judul, durasi).
//
// Class ini sekaligus menjadi tempat seluruh fitur pengelolaan data (baca/simpan
// JSON, validasi, tambah data, cari data), sama seperti class Film pada versi
// PHP sebelumnya yang menyatukan data + fitur dalam satu class.
class FilmFranchise extends Film {
    const FILE_DATA = __DIR__ . "/data.json";   // tempat menyimpan data (file JSON, bukan database)
    const FOLDER_GAMBAR = "image/";             // folder gambar (lokal)
    const MAKS_DATA = 100;

    private $jilidKe;                  // film ini jilid/urutan ke berapa dalam franchise-nya
    private $namaFranchise;            // nama franchise-nya, misal "Fast & Furious"
    private $judulSelanjutnya;         // judul film sesudah ini, "-" kalau belum ada

    // Constructor: bagian Film (dan otomatis Tontonan) diteruskan ke atas
    public function __construct($id = 0, $judul = "", $durasi = 0, $genre = "", $sutradara = "", $ratingUsia = "", $gambar = "",
                                 $jilidKe = 0, $namaFranchise = "", $judulSelanjutnya = "") {
        parent::__construct($id, $judul, $durasi, $genre, $sutradara, $ratingUsia, $gambar);
        $this->jilidKe = $jilidKe;
        $this->namaFranchise = $namaFranchise;
        $this->judulSelanjutnya = $judulSelanjutnya;
    }

    public function __destruct() {
    }

    // ===== Getter =====
    public function getJilidKe() { return $this->jilidKe; }
    public function getNamaFranchise() { return $this->namaFranchise; }
    public function getJudulSelanjutnya() { return $this->judulSelanjutnya; }

    // ===== Setter =====
    public function setJilidKe($jilidKe) { $this->jilidKe = $jilidKe; }
    public function setNamaFranchise($namaFranchise) { $this->namaFranchise = $namaFranchise; }
    public function setJudulSelanjutnya($judulSelanjutnya) { $this->judulSelanjutnya = $judulSelanjutnya; }

    // ===== Penyimpanan data =====
    // PHP selalu mulai dari nol di setiap halaman, jadi data disimpan di file data.json

    // Membaca data.json, hasilnya array of object FilmFranchise
    public function muatData() {
        $daftar = [];

        if (file_exists(self::FILE_DATA)) {
            $isi = json_decode(file_get_contents(self::FILE_DATA), true);

            if (is_array($isi)) {
                foreach ($isi as $d) {
                    $daftar[] = new FilmFranchise(
                        $d["id"], $d["judul"], $d["durasi"], $d["genre"], $d["sutradara"], $d["ratingUsia"], $d["gambar"],
                        $d["jilidKe"], $d["namaFranchise"], $d["judulSelanjutnya"]
                    );
                }
            }
        }

        return $daftar;
    }

    // Menulis seluruh array film ke data.json. Hasilnya true kalau berhasil.
    public function simpanData($daftar) {
        $isi = [];

        foreach ($daftar as $film) {
            $isi[] = [
                "id" => $film->getId(),
                "judul" => $film->getJudul(),
                "durasi" => $film->getDurasi(),
                "genre" => $film->getGenre(),
                "sutradara" => $film->getSutradara(),
                "ratingUsia" => $film->getRatingUsia(),
                "gambar" => $film->getGambar(),
                "jilidKe" => $film->getJilidKe(),
                "namaFranchise" => $film->getNamaFranchise(),
                "judulSelanjutnya" => $film->getJudulSelanjutnya()
            ];
        }

        return file_put_contents(self::FILE_DATA, json_encode($isi, JSON_PRETTY_PRINT), LOCK_EX) !== false;
    }

    // ===== Validasi input =====
    // Semua method cek mengembalikan pesan error, atau "" kalau input sudah benar.

    // Cek angka bulat. "minimal" = angka terkecil yang boleh diterima.
    public function cekAngka($nilai, $nama, $minimal) {
        $nilai = trim((string)$nilai);

        // Harus angka saja (boleh diawali minus supaya bisa dibedakan dari huruf)
        if (!preg_match('/^-?[0-9]+$/', $nilai) || strlen(ltrim($nilai, "-")) > 9) {
            return "$nama harus berupa angka bulat (maksimal 9 digit)!";
        }
        if ((int)$nilai < 0) {
            return "$nama tidak boleh negatif!";
        }
        if ((int)$nilai < $minimal) {
            return "$nama tidak boleh kurang dari $minimal!";
        }
        return "";
    }

    // Cek teks. Tidak boleh kosong atau hanya spasi.
    public function cekTeks($nilai, $nama) {
        if (trim((string)$nilai) == "") {
            return "$nama tidak boleh kosong!";
        }
        return "";
    }

    // Cek gambar yang diupload. $wajib = true kalau gambar harus dipilih.
    private function cekGambar($file, $wajib) {
        if (!isset($file) || $file["error"] == UPLOAD_ERR_NO_FILE) {
            return $wajib ? "Gambar wajib dipilih!" : "";
        }
        if ($file["error"] != UPLOAD_ERR_OK) {
            return "Gambar gagal diupload!";
        }
        if ($file["size"] > 2 * 1024 * 1024) {
            return "Ukuran gambar maksimal 2 MB!";
        }

        $ekstensi = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        if (!in_array($ekstensi, ["jpg", "jpeg", "png", "gif", "webp"])) {
            return "Gambar harus berformat jpg, jpeg, png, gif, atau webp!";
        }
        if (getimagesize($file["tmp_name"]) === false) {
            return "File yang dipilih bukan gambar yang valid!";
        }
        return "";
    }

    // Cek semua kolom selain ID. Hasilnya array berisi pesan error (kosong = aman).
    private function cekFilmFranchise($data, $file, $gambarWajib) {
        $error = [];

        $pesan = $this->cekTeks($data["judul"] ?? "", "Judul");
        if ($pesan != "") $error[] = $pesan;

        $pesan = $this->cekAngka($data["durasi"] ?? "", "Durasi", 1);
        if ($pesan != "") $error[] = $pesan;

        $pesan = $this->cekTeks($data["genre"] ?? "", "Genre");
        if ($pesan != "") $error[] = $pesan;

        $pesan = $this->cekTeks($data["sutradara"] ?? "", "Sutradara");
        if ($pesan != "") $error[] = $pesan;

        $pesan = $this->cekTeks($data["ratingUsia"] ?? "", "Rating usia");
        if ($pesan != "") $error[] = $pesan;

        $pesan = $this->cekAngka($data["jilidKe"] ?? "", "Jilid ke", 1);
        if ($pesan != "") $error[] = $pesan;

        $pesan = $this->cekTeks($data["namaFranchise"] ?? "", "Nama franchise");
        if ($pesan != "") $error[] = $pesan;

        $pesan = $this->cekTeks($data["judulSelanjutnya"] ?? "", 'Judul selanjutnya (isi "-" jika belum ada)');
        if ($pesan != "") $error[] = $pesan;

        $pesan = $this->cekGambar($file, $gambarWajib);
        if ($pesan != "") $error[] = $pesan;

        return $error;
    }

    // ===== Gambar =====

    // Memindahkan gambar upload ke folder image/, hasilnya path-nya (untuk disimpan di data)
    private function simpanGambar($file) {
        if (!is_dir(__DIR__ . "/" . self::FOLDER_GAMBAR)) {
            mkdir(__DIR__ . "/" . self::FOLDER_GAMBAR, 0777, true);
        }

        $ekstensi = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $namaBaru = uniqid("film_") . "." . $ekstensi;   // nama unik supaya tidak saling menimpa

        move_uploaded_file($file["tmp_name"], __DIR__ . "/" . self::FOLDER_GAMBAR . $namaBaru);

        return self::FOLDER_GAMBAR . $namaBaru;
    }

    // ===== Fitur-fitur =====
    // Tanda & pada "&$daftar" artinya array di halaman ikut berubah.

    // Mencari posisi film berdasarkan ID, kalau tidak ketemu hasilnya -1
    private function cariIndex($daftar, $idCari) {
        for ($i = 0; $i < count($daftar); $i++) {
            if ($daftar[$i]->getId() == (int)$idCari) {
                return $i;
            }
        }
        return -1;
    }

    // Hasilnya array pesan error. Kalau kosong berarti berhasil.
    public function tambahData(&$daftar, $data, $file) {
        if (count($daftar) >= self::MAKS_DATA) {
            return ["Data sudah penuh!"];
        }

        $error = [];

        // Cek ID: harus angka, minimal 1, dan tidak boleh sama
        $pesan = $this->cekAngka($data["id"] ?? "", "ID", 1);
        if ($pesan != "") {
            $error[] = $pesan;
        } elseif ($this->cariIndex($daftar, $data["id"]) != -1) {
            $error[] = "ID sudah dipakai!";
        }

        // Gambar sengaja dibuat TIDAK wajib dulu (pakai gambar alternate/placeholder
        // kalau tidak diupload), karena gambar asli akan dipasang sendiri belakangan.
        $error = array_merge($error, $this->cekFilmFranchise($data, $file, false));
        if (count($error) > 0) {
            return $error;
        }
        $gambar = ($file !== null && $file["error"] == UPLOAD_ERR_OK)
            ? $this->simpanGambar($file)
            : "https://placehold.co/240x340?text=No+Image";

        $daftar[] = new FilmFranchise(
            (int)$data["id"], trim($data["judul"]), (int)$data["durasi"],
            trim($data["genre"]), trim($data["sutradara"]), trim($data["ratingUsia"]), $gambar,
            (int)$data["jilidKe"], trim($data["namaFranchise"]), trim($data["judulSelanjutnya"])
        );

        if (!$this->simpanData($daftar)) {
            $error[] = "Gagal menyimpan data! Pastikan folder bisa ditulis.";
        }
        return $error;
    }

    // Hasilnya object FilmFranchise, atau null kalau tidak ditemukan
    public function cariData($daftar, $idCari) {
        $index = $this->cariIndex($daftar, $idCari);

        if ($index == -1) {
            return null;
        }
        return $daftar[$index];
    }
}
