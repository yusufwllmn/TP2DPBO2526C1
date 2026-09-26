#ifndef FILM_CPP
#define FILM_CPP

#include "Tontonan.cpp"

// Class level 2: Film
// Film adalah Tontonan yang punya genre, sutradara, dan batasan usia penonton.
// Lewat "public Tontonan", Film otomatis punya id, judul, durasi, beserta
// getter dan setter-nya, tanpa perlu menulis ulang.
class Film : public Tontonan {
private:
    string genre;
    string sutradara;
    string ratingUsia;   // contoh: "SU", "13+", "17+", "21+"

public:
    // Constructor kosong (dibutuhkan supaya bisa membuat array "Film daftar[100]")
    Film() : Tontonan() {
        genre = "";
        sutradara = "";
        ratingUsia = "";
    }

    // Constructor dengan isi: bagian id, judul, durasi diteruskan ke constructor Tontonan
    Film(int id, string judul, int durasi, string genre, string sutradara, string ratingUsia)
        : Tontonan(id, judul, durasi) {
        this->genre = genre;
        this->sutradara = sutradara;
        this->ratingUsia = ratingUsia;
    }

    ~Film() {
    }

    // ===== Getter =====
    string getGenre() { return genre; }
    string getSutradara() { return sutradara; }
    string getRatingUsia() { return ratingUsia; }

    // ===== Setter =====
    void setGenre(string genre) { this->genre = genre; }
    void setSutradara(string sutradara) { this->sutradara = sutradara; }
    void setRatingUsia(string ratingUsia) { this->ratingUsia = ratingUsia; }
};

#endif