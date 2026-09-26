/* Saya Yusuf Willman Hammam dengan NIM 2511185 mengerjakan Tugas Praktikum 2 
dalam mata kuliah Desain Pemrograman Berorientasi Objek (DPBO) untuk keberkahan-Nya 
maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin. */

#include <iostream>
#include <string>
#include <sstream>
#include <cstdlib>   // untuk exit()
#include "FilmFranchise.cpp"
using namespace std;

FilmFranchise daftar[100];   // array of object untuk menyimpan data film franchise
int jumlah = 0;         // jumlah data yang sudah tersimpan

// ===== Validasi input =====
// Membaca angka bulat. "minimal" = angka terkecil yang boleh diterima.
int bacaAngka(string pesan, int minimal) {
    while (true) {
        cout << pesan;
        string teks;
        if (!getline(cin, teks)) {
            // Input sudah habis (misalnya ditutup dengan Ctrl+D / Ctrl+Z)
            cout << endl << "Input dihentikan." << endl;
            exit(0);
        }

        bool negatif = false;
        string angkaSaja = teks;
        if (!teks.empty() && teks[0] == '-') {
            negatif = true;
            angkaSaja = teks.substr(1);
        }

        bool semuaAngka = !angkaSaja.empty() && angkaSaja.length() <= 9;
        for (char c : angkaSaja) {
            if (c < '0' || c > '9') {
                semuaAngka = false;
            }
        }

        if (!semuaAngka) {
            cout << "Input harus berupa angka bulat!" << endl;
        } else if (negatif) {
            cout << "Angka tidak boleh negatif!" << endl;
        } else if (stoi(angkaSaja) < minimal) {
            cout << "Angka tidak boleh kurang dari " << minimal << "!" << endl;
        } else {
            return stoi(angkaSaja);
        }
    }
}

// Membaca teks. Tidak boleh kosong atau hanya spasi.
string bacaTeks(string pesan) {
    while (true) {
        cout << pesan;
        string teks;
        if (!getline(cin, teks)) {
            cout << endl << "Input dihentikan." << endl;
            exit(0);
        }

        if (teks.find_first_not_of(" \t") == string::npos) {
            cout << "Input tidak boleh kosong!" << endl;
        } else {
            return teks;
        }
    }
}

// Mencari posisi film berdasarkan ID, kalau tidak ketemu hasilnya -1
int cariIndex(int idCari) {
    for (int i = 0; i < jumlah; i++) {
        if (daftar[i].getId() == idCari) {
            return i;
        }
    }
    return -1;
}

// Mengisi 5 data contoh sebelum program menerima input dari user
void isiDataDefault() {
    // jilidKe dihitung dari urutan film DI DALAM franchise-nya sendiri,
    // bukan urutan lintas semesta (misalnya Avengers: Endgame BUKAN film ke-22,
    // itu urutan gabungan seluruh semesta MCU. Dalam franchise Avengers saja,
    // dia jilid ke-4: Avengers, Age of Ultron, Infinity War, Endgame).
    daftar[jumlah++] = FilmFranchise(1, "Avengers: Endgame", 181, "Aksi", "Anthony Russo", "13+",
                                     4, "Avengers", "-");
    daftar[jumlah++] = FilmFranchise(2, "John Wick 4", 169, "Aksi", "Chad Stahelski", "17+",
                                     4, "John Wick", "-");
    daftar[jumlah++] = FilmFranchise(3, "Fast X", 141, "Aksi", "Louis Leterrier", "13+",
                                     10, "Fast & Furious", "Fast & Furious 11");
    daftar[jumlah++] = FilmFranchise(4, "Toy Story 4", 100, "Animasi", "Josh Cooley", "SU",
                                     4, "Toy Story", "-");
    daftar[jumlah++] = FilmFranchise(5, "Spider-Man: No Way Home", 148, "Aksi", "Jon Watts", "13+",
                                     3, "Spider-Man (Trilogi Home)", "-");
}

// Fitur Tambah Data
void tambahData() {
    if (jumlah >= 100) {
        cout << "Data sudah penuh!" << endl;
        return;
    }

    int id = bacaAngka("ID              : ", 1);

    if (cariIndex(id) != -1) {
        cout << "ID sudah dipakai!" << endl;
        return;
    }

    string judul = bacaTeks("Judul           : ");
    int durasi = bacaAngka("Durasi (menit)  : ", 1);
    string genre = bacaTeks("Genre           : ");
    string sutradara = bacaTeks("Sutradara       : ");
    string ratingUsia = bacaTeks("Rating Usia     : ");
    int jilid = bacaAngka("Jilid Ke        : ", 1);
    string franchise = bacaTeks("Nama Franchise  : ");
    string selanjutnya = bacaTeks("Judul Selanjutnya (\"-\" jika belum ada): ");

    daftar[jumlah] = FilmFranchise(id, judul, durasi, genre, sutradara, ratingUsia,
                                   jilid, franchise, selanjutnya);
    jumlah++;

    cout << "Data berhasil ditambahkan!" << endl;
}

// Fitur Tampilkan Data: tabel dengan lebar kolom yang menyesuaikan isi
void tampilData() {
    if (jumlah == 0) {
        cout << "Belum ada data film." << endl;
        return;
    }

    // Judul kolom (urut sesuai urutan pewarisan: dari Tontonan, lalu Film, lalu FilmFranchise)
    string header[9] = {
        "ID", "Judul", "Durasi", "Genre", "Sutradara", "Rating",
        "Jilid", "Franchise", "Judul Selanjutnya"
    };
    const int JUMLAH_KOLOM = 9;

    // Langkah 1: lebar default setiap kolom dihitung dari panjang judul kolomnya
    int lebar[JUMLAH_KOLOM];
    for (int k = 0; k < JUMLAH_KOLOM; k++) {
        lebar[k] = header[k].length();
    }

    // Kumpulkan isi setiap baris jadi teks dahulu, supaya panjangnya bisa dihitung
    string isi[100][JUMLAH_KOLOM];
    for (int i = 0; i < jumlah; i++) {
        // to_string dipakai untuk mengubah angka menjadi teks
        isi[i][0] = to_string(daftar[i].getId());
        isi[i][1] = daftar[i].getJudul();
        isi[i][2] = to_string(daftar[i].getDurasi()) + " menit";
        isi[i][3] = daftar[i].getGenre();
        isi[i][4] = daftar[i].getSutradara();
        isi[i][5] = daftar[i].getRatingUsia();
        isi[i][6] = to_string(daftar[i].getJilidKe());
        isi[i][7] = daftar[i].getNamaFranchise();
        isi[i][8] = daftar[i].getJudulSelanjutnya();
    }

    // Langkah 2: lebar tiap kolom dihitung ulang, dibesarkan jika ada isi yang lebih panjang
    for (int i = 0; i < jumlah; i++) {
        for (int k = 0; k < JUMLAH_KOLOM; k++) {
            if ((int)isi[i][k].length() > lebar[k]) {
                lebar[k] = isi[i][k].length();
            }
        }
    }

    // Menghitung total lebar tabel untuk garis pemisah
    int totalLebar = 1;   // 1 untuk tanda '|' di paling kiri
    for (int k = 0; k < JUMLAH_KOLOM; k++) {
        totalLebar += lebar[k] + 3;   // 3 = spasi kiri + spasi kanan + tanda '|'
    }

    string garis(totalLebar, '-');

    // Mencetak judul kolom
    cout << garis << endl;
    cout << "|";
    for (int k = 0; k < JUMLAH_KOLOM; k++) {
        cout << " " << header[k];
        // Tambahkan spasi supaya lebarnya sama dengan "lebar[k]"
        for (int s = header[k].length(); s < lebar[k]; s++) {
            cout << " ";
        }
        cout << " |";
    }
    cout << endl << garis << endl;

    // Mencetak isi tabel
    for (int i = 0; i < jumlah; i++) {
        cout << "|";
        for (int k = 0; k < JUMLAH_KOLOM; k++) {
            cout << " " << isi[i][k];
            for (int s = isi[i][k].length(); s < lebar[k]; s++) {
                cout << " ";
            }
            cout << " |";
        }
        cout << endl;
    }
    cout << garis << endl;
}

int main() {
    isiDataDefault();   // 5 data contoh dimasukkan lebih dulu, sebelum ada input user

    int pilihan;

    do {
        cout << endl;
        cout << "=== DATA FILM BIOSKOP (Tontonan -> Film -> FilmFranchise) ===" << endl;
        cout << "1. Tambah Data" << endl;
        cout << "2. Tampilkan Data" << endl;
        cout << "0. Keluar" << endl;
        pilihan = bacaAngka("Pilih menu: ", 0);
        cout << endl;

        if (pilihan == 1) {
            tambahData();
        } else if (pilihan == 2) {
            tampilData();
        } else if (pilihan == 0) {
            cout << "Terima kasih!" << endl;
        } else {
            cout << "Menu tidak valid!" << endl;
        }

    } while (pilihan != 0);

    return 0;
}