#ifndef FILMFRANCHISE_CPP
#define FILMFRANCHISE_CPP

#include "Film.cpp"

// Class level 3 (paling bawah): FilmFranchise
// FilmFranchise adalah Film yang merupakan bagian dari sebuah franchise/waralaba,
// sehingga punya info jilid keberapa dan film sesudahnya.
// Lewat "public Film", FilmFranchise otomatis mewarisi seluruh atribut dari Film
// (genre, sutradara, ratingUsia) SEKALIGUS dari Tontonan (id, judul, durasi).
class FilmFranchise : public Film {
private:
    int jilidKe;                  // film ini jilid/urutan ke berapa dalam franchise-nya
    string namaFranchise;         // nama franchise-nya, misal "Fast & Furious"
    string judulSelanjutnya;      // judul film sesudah ini, "-" kalau belum ada

public:
    // Constructor kosong (dibutuhkan supaya bisa membuat array "FilmFranchise daftar[100]")
    FilmFranchise() : Film() {
        jilidKe = 0;
        namaFranchise = "";
        judulSelanjutnya = "";
    }

    // Constructor dengan isi: bagian Film (dan otomatis Tontonan) diteruskan ke atas
    FilmFranchise(int id, string judul, int durasi, string genre, string sutradara, string ratingUsia,
                  int jilidKe, string namaFranchise, string judulSelanjutnya)
        : Film(id, judul, durasi, genre, sutradara, ratingUsia) {
        this->jilidKe = jilidKe;
        this->namaFranchise = namaFranchise;
        this->judulSelanjutnya = judulSelanjutnya;
    }

    ~FilmFranchise() {
    }

    // ===== Getter =====
    int getJilidKe() { return jilidKe; }
    string getNamaFranchise() { return namaFranchise; }
    string getJudulSelanjutnya() { return judulSelanjutnya; }

    // ===== Setter =====
    void setJilidKe(int jilidKe) { this->jilidKe = jilidKe; }
    void setNamaFranchise(string namaFranchise) { this->namaFranchise = namaFranchise; }
    void setJudulSelanjutnya(string judulSelanjutnya) { this->judulSelanjutnya = judulSelanjutnya; }
};

#endif