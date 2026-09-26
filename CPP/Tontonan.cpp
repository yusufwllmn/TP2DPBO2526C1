#ifndef TONTONAN_CPP
#define TONTONAN_CPP

#include <iostream>
#include <string>
using namespace std;

// Class paling atas (level 1): Tontonan
// Berisi hal paling umum yang dimiliki SEGALA jenis tontonan di bioskop,
// belum tentu berupa film (bisa saja nanti dikembangkan jadi Iklan, Trailer, dsb).
class Tontonan {
private:
    int id;
    string judul;
    int durasi;   // dalam menit

public:
    // Constructor kosong (dibutuhkan supaya bisa membuat array "Tontonan daftar[100]")
    Tontonan() {
        id = 0;
        judul = "";
        durasi = 0;
    }

    // Constructor dengan isi
    Tontonan(int id, string judul, int durasi) {
        this->id = id;
        this->judul = judul;
        this->durasi = durasi;
    }

    // Destructor: tidak ada yang perlu dibersihkan di class ini
    ~Tontonan() {
    }

    // ===== Getter =====
    int getId() { return id; }
    string getJudul() { return judul; }
    int getDurasi() { return durasi; }

    // ===== Setter =====
    void setId(int id) { this->id = id; }
    void setJudul(string judul) { this->judul = judul; }
    void setDurasi(int durasi) { this->durasi = durasi; }
};

#endif